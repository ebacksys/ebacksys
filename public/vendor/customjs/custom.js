

function deleteRow(button) {
    // Get the row containing the clicked button
    const row = button.closest('tr');

    // Remove the row from the table
    row.remove();
}

function openUrl(button) {
    // Get the row containing the clicked button
    const row = button.closest('tr');

    // Get the second cell in the row (index 1)
    const cell = row.cells[1];

    // Get the input element within the cell
    const input = cell.querySelector('input');

    // Get the URL from the input field
    const url = input.value;

    // Open the URL in a new tab
    window.open(url, '_blank');
}

function openUrl2(button) {
    // Get the row containing the clicked button
    const row = button.closest('tr');

    // Get the second cell in the row (index 1)
    const cell = row.cells[1];

    // Get the input element within the cell
    const input = cell.querySelector('input');

    // Get the URL from the input field
    const url = input.value;

    // Check if the URL is a file URL
    if (url.startsWith('file://')) {
        // Convert the file URL to a local file path
        const filePath = url.replace('file://', 'file:\\\\');

        // Open the local file path using Windows Explorer
        window.location.href = filePath;
    } else {
        // Open the URL in a new tab
        window.open(url, '_blank');
    }
}
