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
