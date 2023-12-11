

function calculateAge() {
    var dob = document.getElementById('dob').value;
    var today = new Date();
    var birthDate = new Date(dob);
    var age = today.getFullYear() - birthDate.getFullYear();

    // Adjust age if birthday hasn't occurred yet this year
    if (today.getMonth() < birthDate.getMonth() || (today.getMonth() === birthDate.getMonth() && today.getDate() < birthDate.getDate())) {
        age--;
    }

    document.getElementById('age').value = age;
}

function validateForm() {
    var name = document.getElementById('name').value;
    var dob = document.getElementById('dob').value;
    var experience = document.getElementById('experience').value;
    var department = document.getElementById('department').value;
    var address = document.getElementById('address').value;
    var employee_id = document.getElementById('employee_id').value;
    var salary = document.getElementById('salary').value;
    var designation = document.getElementById('designation').value;

    // Simple validation, you can add more checks as needed
    if (name === "" || dob === "" || experience === "" || department === "" || address === "" || employee_id === "" || salary === "" || designation === "") {
        alert("All fields must be filled out");
        return false;
    }


    return true;
}

