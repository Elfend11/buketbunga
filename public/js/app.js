document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('[data-estimator-form]');
    if (!form) return;

    const output = document.querySelector('[data-estimated-total]');
    const submit = async () => {
        const formData = new FormData(form);
        const data = {
            option_value_ids: formData.getAll('option_value_ids').map(Number),
            add_on_ids: formData.getAll('add_on_ids').map(Number),
        };

        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            },
            body: JSON.stringify(data),
        });

        if (!response.ok) return;
        const result = await response.json();
        if (output) {
            output.textContent = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0,
            }).format(result.estimated_total);
        }
    };

    form.addEventListener('change', submit);
});
