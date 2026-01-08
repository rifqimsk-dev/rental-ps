const tabs = document.querySelectorAll(".tab-btn");
const contents = document.querySelectorAll(".tab-content");

tabs.forEach((tab, index) => {
    tab.addEventListener("click", () => {
        tabs.forEach((t) => {
            t.classList.remove(
                "border-slate-500",
                "text-slate-700",
                "bg-white"
            );
            t.classList.add("border-transparent", "text-slate-400");
        });

        contents.forEach((c) => c.classList.add("hidden"));

        tab.classList.add("border-slate-500", "text-slate-700", "bg-white");
        tab.classList.remove("border-transparent", "text-slate-400");

        contents[index].classList.remove("hidden");
    });
});

const tabs2 = document.querySelectorAll(".tab-btn2");
const contents2 = document.querySelectorAll(".tab-content2");

tabs2.forEach((tab, index) => {
    tab.addEventListener("click", () => {
        // reset semua tab
        tabs2.forEach((t) => {
            t.classList.remove("bg-blue-500", "text-white");
            t.classList.add("text-slate-500");
        });

        // sembunyikan semua konten
        contents2.forEach((c) => c.classList.add("hidden"));

        // aktifkan tab yg diklik
        tab.classList.add("bg-blue-500", "text-white");
        tab.classList.remove("text-slate-500");

        // tampilkan konten
        contents2[index].classList.remove("hidden");
    });
});
