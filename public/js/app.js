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

document.getElementById('btn-clear').addEventListener('click', () => {
    let input = document.getElementById('search'),
    select = document.getElementById('filter_company_id');

    input.value = "";
    select.selectedIndex = 0;

    window.location.href = window.location.href.split('?')[0];
});

const toggleClearButton = () => {
    let query = location.search,
    pattern = /[?&]search=/, // ?company_id=1&search=test
    button = document.getElementById('btn-clear');

    if(pattern.test(query)) {
        button.style.display = 'block';
    }else {
        button.style.display = 'none';
    }
};

toggleClearButton();
