document.getElementById('filter_company_id').addEventListener('change', function() {
    let companyId = this.value || this.options[this.selectedIndex].value;
    window.location.href = window.location.href.split('?')[0] + '?company_id=' + companyId;
});

document.querySelectorAll('.btn-delete').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm("Are you sure?")) {
            let url = this.getAttribute('href');
            let form = document.getElementById('form-delete');
            form.setAttribute('action', url);
            form.submit();
        }

    });
});
