function formatTime(seconds) {
    const hrs = Math.floor(seconds / 3600);
    const mins = Math.floor((seconds % 3600) / 60);
    const secs = seconds % 60;
    return `${hrs.toString().padStart(2, "0")}:${mins
        .toString()
        .padStart(2, "0")}:${secs.toString().padStart(2, "0")}`;
}

const timers = document.querySelectorAll(".timer");

timers.forEach((timerEl) => {
    const timerText = timerEl.querySelector(".timer-text");
    const iconEl = timerEl.querySelector("i");
    const endTime = new Date(timerEl.dataset.endtime).getTime();

    const interval = setInterval(() => {
        const now = new Date().getTime();
        let totalTime = Math.floor((endTime - now) / 1000);

        if (totalTime <= 0) {
            clearInterval(interval);
            timerText.textContent = "Selesai";
            iconEl.className = "fas fa-check-circle";
            return;
        }

        timerText.textContent = formatTime(totalTime);
    }, 1000);
});
