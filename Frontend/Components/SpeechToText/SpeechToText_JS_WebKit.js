Nagraj_glos.addEventListener("click", function () {
  startMowy = true;
  window.SpeechRecognition = window.webkitSpeechRecognition;
  const recognition = new SpeechRecognition();
  recognition.interimResult = true;

  recognition.addEventListener("result", (e) => {
    const transcript = Array.from(e.results)
      .map((result) => result[0])
      .map((result) => result.transcript);
    inputSzukaj.value = transcript;
  });

  if (startMowy == true) {
    recognition.start();
  }
});
