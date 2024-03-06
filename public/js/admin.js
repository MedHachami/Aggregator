document.addEventListener("DOMContentLoaded", function () {
    fetch('/api/getUsers', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
        },
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            $('#data-table-user').DataTable({
                data: data.data,
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'roles' },

                ],
            });
        })
        .catch(error => console.error('Error fetching data:', error));

});