import { ref, onMounted, onBeforeUnmount } from 'vue'

const YOUTUBE_API_KEY = 'AIzaSyC2DO4xkI5XO7LKWWxDqXneCJ7MvP8L8HA'
const CHANNEL_ID = 'UCqYw-CTd1dU2yGI71sEyqNw'

export const useLiveStream = () => {
    const isLive = ref(false)
    const liveViewerCount = ref(0)
    const liveTitle = ref('')
    const liveVideoId = ref<string | null>(null)

    const checkLiveStreams = async () => {
        try {
            const liveResponse = await fetch(
                `https://www.googleapis.com/youtube/v3/search?key=${YOUTUBE_API_KEY}&channelId=${CHANNEL_ID}&eventType=live&type=video&part=snippet`
            )
            const liveData = await liveResponse.json()

            if (liveData.items && liveData.items.length > 0) {
                const liveItem = liveData.items[0]
                isLive.value = true
                liveVideoId.value = liveItem.id.videoId
                liveTitle.value = liveItem.snippet.title

                const detailsResponse = await fetch(
                    `https://www.googleapis.com/youtube/v3/videos?key=${YOUTUBE_API_KEY}&id=${liveItem.id.videoId}&part=liveStreamingDetails`
                )
                const detailsData = await detailsResponse.json()

                if (detailsData.items && detailsData.items.length > 0) {
                    liveViewerCount.value = parseInt(detailsData.items[0].liveStreamingDetails.concurrentViewers || '0')
                }
            } else {
                isLive.value = false
                liveVideoId.value = null
                liveViewerCount.value = 0
                liveTitle.value = ''
            }
        } catch (err) {
            console.error('Error checking live streams:', err)
            isLive.value = false
        }
    }

    let interval: ReturnType<typeof setInterval> | null = null

    onMounted(() => {
        checkLiveStreams()
        interval = setInterval(checkLiveStreams, 60000)
    })

    onBeforeUnmount(() => {
        if (interval) {
            clearInterval(interval)
        }
    })

    return {
        isLive,
        liveViewerCount,
        liveTitle,
        liveVideoId,
        checkLiveStreams
    }
}
