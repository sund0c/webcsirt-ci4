document.addEventListener("DOMContentLoaded", function () {
    const toast = document.getElementById("toast");
    if (!toast) return;

    setTimeout(() => {
        toast.style.transition = "opacity 0.5s ease";
        toast.style.opacity = "0";
    }, 3000);

    setTimeout(() => {
        toast.remove();
    }, 3500);
});
