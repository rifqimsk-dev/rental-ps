const modal = document.getElementById("addModal");
const backdrop = document.getElementById("modalBackdrop");

function openModal() {
    backdrop.classList.remove("pointer-events-none", "opacity-0");
    backdrop.classList.add("opacity-100");

    modal.classList.remove("translate-y-full", "scale-95", "opacity-0");
    modal.classList.add("translate-y-0", "scale-100", "opacity-100");
}

function closeModal() {
    backdrop.classList.add("opacity-0");
    backdrop.classList.remove("opacity-100");

    modal.classList.add("translate-y-full", "scale-95", "opacity-0");
    modal.classList.remove("translate-y-0", "scale-100", "opacity-100");

    setTimeout(() => {
        backdrop.classList.add("pointer-events-none");
    }, 300);
}
