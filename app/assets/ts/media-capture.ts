const video = document.getElementById('video');

const MEDIA_CONSTRAINTS: MediaStreamConstraints = {
  audio: false,
  video: true,
};

async function getMedia(constraints: MediaStreamConstraints): Promise<void> {
  let stream = null;

  try {
    stream = await navigator.mediaDevices.getUserMedia(constraints);
    /* use the stream */
    // video.srcObject = stream;
  } catch (err) {
    /* handle the error */
  }
}

window.addEventListener(
  'load',
  (): Promise<void> => getMedia(MEDIA_CONSTRAINTS)
);
