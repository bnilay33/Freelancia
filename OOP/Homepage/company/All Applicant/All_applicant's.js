document.getElementById('applicantLink').addEventListener('click', function() {
    openPopup();
    fetchUserData();
});

function openPopup() {
    document.getElementById('popup').style.display = 'block';
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

function fetchUserData() {
    // You can customize the URL based on your server-side script and requirements
    var url = 'All_applicant.php';

    fetch(url)
        .then(response => response.json())
        .then(data => {
            displayUserData(data);
        })
        .catch(error => {
            console.error('Error fetching user data:', error);
        });
}

function displayUserData(data) {
    var popupContent = document.getElementById('popupContent');
    popupContent.innerHTML = '';

    for (var key in data) {
        if (data.hasOwnProperty(key)) {
            popupContent.innerHTML += `<p><strong>${key}:</strong> ${data[key]}</p>`;
        }
    }
}