// // Ganti querySelectorAll dengan event delegation
// document.addEventListener('click', function (e) {
//     const btn = e.target.closest('.btn-delete');
//     if (!btn) return;

//     const id    = btn.dataset.deleteId;
//     const title = btn.dataset.deleteTitle;
//     const url   = btn.dataset.deleteUrl;
//     openDeleteModal(id, title, url);
// });

// // Tutup modal saat klik backdrop
// document.addEventListener('click', function (e) {
//     const modal = document.getElementById('deleteModal');
//     if (e.target === modal) closeDeleteModal();
// });

// document.getElementById('cancelDelete')
//     ?.addEventListener('click', closeDeleteModal);

// function openDeleteModal(id, title, baseUrl) {
//     document.getElementById('deleteForm').action = baseUrl + id;
//     document.getElementById('deleteTarget').textContent = title;

//     const modal = document.getElementById('deleteModal');
//     modal.classList.remove('hidden');
//     modal.classList.add('flex');
// }

// function closeDeleteModal() {
//     const modal = document.getElementById('deleteModal');
//     modal.classList.add('hidden');
//     modal.classList.remove('flex');
// }


document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('cancelDelete')
        ?.addEventListener('click', closeDeleteModal);

    document.getElementById('cancelRestore')
        ?.addEventListener('click', closeRestoreModal);
    
    // Logout confirmation
document.getElementById('btnLogout')
    ?.addEventListener('click', function (e) {
        e.preventDefault();
        if (confirm('Yakin ingin logout?')) {
            document.getElementById('logoutForm').submit();
        }
    });
    
});

// ===== DELETE =====
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.btn-delete');
    if (!btn) return;

    openDeleteModal(
        btn.dataset.deleteId,
        btn.dataset.deleteTitle,
        btn.dataset.deleteUrl
    );
});

function openDeleteModal(id, title, baseUrl) {
    document.getElementById('deleteForm').action = baseUrl + id;
    document.getElementById('deleteTarget').textContent = title;

    const modal = document.getElementById('deleteModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// ===== RESTORE =====
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.btn-restore');
    if (!btn) return;

    openRestoreModal(
        btn.dataset.restoreId,
        btn.dataset.restoreTitle,
        btn.dataset.restoreUrl
    );
});

function openRestoreModal(id, title, baseUrl) {
    document.getElementById('restoreForm').action = baseUrl + id;
    document.getElementById('restoreTarget').textContent = title;

    const modal = document.getElementById('restoreModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeRestoreModal() {
    const modal = document.getElementById('restoreModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// ===== BACKDROP =====
document.addEventListener('click', function (e) {
    if (e.target === document.getElementById('deleteModal')) closeDeleteModal();
    if (e.target === document.getElementById('restoreModal')) closeRestoreModal();
});

