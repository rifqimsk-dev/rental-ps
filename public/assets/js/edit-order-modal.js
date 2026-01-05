function openEditModal(button) {
    // ambil id transaksi dari button
    const transactionId = button.dataset.id;

    // set ke hidden input
    const inputId = document.getElementById("transaction_id");
    if (inputId) {
        inputId.value = transactionId;
    }

    const modal = document.getElementById("editModal");
    if (!modal) return;

    const content = modal.querySelector(".modal-content");

    // tampilkan modal
    modal.classList.remove("pointer-events-none", "opacity-0");
    modal.classList.add("opacity-100");

    if (content) {
        content.classList.remove("scale-95", "translate-y-4");
        content.classList.add("scale-100", "translate-y-0");
    }
}

function closeEditModal() {
    const modal = document.getElementById("editModal");
    if (!modal) return;

    const content = modal.querySelector(".modal-content");

    // animasi keluar
    modal.classList.add("opacity-0");
    modal.classList.remove("opacity-100");

    if (content) {
        content.classList.add("scale-95", "translate-y-4");
        content.classList.remove("scale-100", "translate-y-0");
    }

    // disable interaksi setelah animasi selesai
    setTimeout(() => {
        modal.classList.add("pointer-events-none");
    }, 300);
}
