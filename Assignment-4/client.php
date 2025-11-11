<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            padding: 20px;
        }

        .table {
            border-radius: 15px;

            overflow: hidden;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #fff;
            font-size: 2.2rem;
            margin-bottom: 10px;
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.7),
                0 0 20px rgba(0, 255, 255, 0.5);
        }

        .header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
            margin-bottom: 30px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #fff;
            font-weight: 500;
            font-size: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 14px 15px;
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.07);
            color: #fff;
            font-size: 16px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .form-control:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
            border: 1px solid rgba(0, 255, 255, 0.5);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #fff;
            white-space: nowrap;
        }

        .radio-option input {
            accent-color: #00ffff;
        }

        .crud-buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 25px;
        }

        .btn {
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .btn-create {
            background: linear-gradient(45deg, #00b4db, #0083b0);
            color: white;
        }

        .btn-read {
            background: linear-gradient(45deg, #00c9ff, #92fe9d);
            color: white;
        }

        .btn-update {
            background: linear-gradient(45deg, #a8ff78, #78ffd6);
            color: #333;
        }

        .btn-delete {
            background: linear-gradient(45deg, #ff5f6d, #ffc371);
            color: white;
        }

        .btn-reset {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            grid-column: span 2;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        .student-table-container {
            overflow-x: auto;
            border-radius: 15px;
            margin-top: 30px;
        }

        .student-table {
            width: 100%;
            background: rgba(255, 255, 255, 0.07);
            border-radius: 15px;
            border-collapse: collapse;
            min-width: 600px;
        }

        .student-table th {
            background: rgba(0, 255, 255, 0.2);
            padding: 15px 12px;
            text-align: left;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .student-table td {
            padding: 12px;
            color: rgba(255, 255, 255, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
        }

        .student-table tr:last-child td {
            border-bottom: none;
        }

        .student-table tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .action-btn {
            background: none;
            border: none;
            color: #00ffff;
            cursor: pointer;
            font-size: 16px;
            margin-right: 8px;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            text-shadow: 0 0 5px rgba(0, 255, 255, 0.7);
        }

        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            backdrop-filter: blur(4px);
        }


        .popup-content {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 30px 40px;
            text-align: center;
            width: 90%;
            max-width: 500px;
            color: #fff;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            animation: fadeIn 0.3s ease;
        }


        .popup-content p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }


        .popup-btn {
            padding: 10px 20px;
            background: rgba(255, 75, 43, 0.85);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .popup-btn:hover {
            background: rgba(255, 75, 43, 1);
            transform: scale(1.05);
        }


        @media (min-width: 480px) {
            .form-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .gender-group {
                grid-column: span 2;
            }
        }

        @media (min-width: 768px) {
            .header h1 {
                font-size: 2.5rem;
            }

            .form-container {
                padding: 30px;
            }

            .crud-buttons {
                grid-template-columns: repeat(5, 1fr);
            }

            .btn-reset {
                grid-column: span 1;
            }

            .table {
                width: 750px;
                border-radius: 15px;
            }

            .student-table th,
            .student-table td {
                padding: 15px;
                font-size: 1rem;

            }
        }

        @media (max-width: 600px) {
            .radio-group {
                flex-direction: column;
                gap: 8px;
            }

            .btn {
                padding: 12px 8px;
                font-size: 14px;
            }

            .table {
                width: 100%;
                border-radius: 15px;
                overflow: scroll;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-user-graduate"></i> Student Management</h1>
            <p>Create, Read, Update & Delete Student Records</p>
        </div>

        <div class="form-container">
            <form id="studentForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name"><i class="fas fa-signature"></i> Full Name</label>
                        <input type="text" id="name" class="form-control" placeholder="Enter full name" required>
                    </div>

                    <div class="form-group">
                        <label for="rollNo"><i class="fas fa-id-card"></i> Roll Number</label>
                        <input type="text" id="roll" class="form-control" placeholder="Enter roll number" required>
                    </div>

                    <div class="form-group">
                        <label for="age"><i class="fas fa-birthday-cake"></i> Age</label>
                        <input type="number" id="age" class="form-control" placeholder="Enter age" min="16" max="30"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Enter email address" required>
                    </div>

                    <div class="form-group">
                        <label for="dob"><i class="fas fa-calendar-alt"></i> Date of Birth</label>
                        <input type="date" id="dob" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-venus-mars"></i> Gender</label>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" name="gender" value="male" required> Male
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="gender" value="female"> Female
                            </label>
                        </div>
                    </div>
                </div>

                <div class="crud-buttons">
                    <button type="button" class="btn btn-create" id="createBtn" onClick="sendData()">
                        <i class="fas fa-plus-circle"></i> Create
                    </button>
                    <button type="button" class="btn btn-read" id="readBtn" onClick="displayData()">
                        <i class="fas fa-eye"></i> Read
                    </button>
                    <button type="button" class="btn btn-update" id="updateBtn" onClick="updateData()">
                        <i class="fas fa-edit"></i> Update
                    </button>
                    <button type="button" class="btn btn-delete" id="deleteBtn" onClick="deleteData()">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                    <button type="reset" class="btn btn-reset">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                </div>
            </form>
        </div>
        <div class="table">
            <table class="student-table" id="studTable">
                <thead id="hed">

                </thead>
                <tbody id="studentData">

                </tbody>
            </table>
        </div>
    </div>

    <script>
        let c = document.getElementById("createBtn");
        let r = document.getElementById("readBtn");
        let u = document.getElementById("updateBtn");
        let d = document.getElementById("deleteBtn");

        
        function updateData() {
                let name, roll, age, email, dob, gender;
                name = document.getElementById("name").value;
                roll = document.getElementById("roll").value;
                age = document.getElementById("age").value;
                email = document.getElementById("email").value;
                dob = document.getElementById("dob").value;
                gender = document.querySelector('input[name="gender"]:checked').value;
               
                 document.getElementById("roll").disabled = false;
                 document.getElementById("roll").style.cursor="Pointer";
                 c.disabled = false;
                 c.style.cursor = "pointer";
                 d.disabled = false;
                 d.style.cursor = "pointer";
                 r.disabled = false;
                 r.style.cursor = "pointer";
                let data = {
                    name: name,
                    roll: roll,
                    age: age,
                    email: email,
                    dob: dob,
                    gender: gender
                }

                console.log("data for updation : ", data);

                fetch("update.php", {
                    method: "POST",
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                    .then(res => { return res.text() })
                    .then(res => {
                        console.log("res : ", res);
                        showPopup(res);
                        displayData();
                    })
                    .catch(err => {
                        showPopup("Error in updating");
                        console.log("error in creating : ", err);
                    })
            }

            function deleteData() {
                let roll = document.getElementById("roll").value;
                if (roll == "") {
                    alert("Enter roll number to delete data");
                    return;
                } else {
                    fetch("delete.php", {
                        method: "POST",
                        headers: {
                            'content-type': 'application/json'
                        },
                        body: JSON.stringify({ roll: roll })
                    })
                        .then(res => { return res.text() })
                        .then(res => {
                            console.log("delete : ", res);
                            displayData();
                            showPopup(res);
                        })
                        .catch(err => {
                            console.log("delete error : ", err);
                            showPopup("Error in deleting");

                        })
                }

            }

       

        function showPopup(message) {
            const popup = document.createElement("div");
            popup.className = "popup";
            popup.innerHTML = `
                <div class="popup-content">
                    <p>${message}</p>
                    <button class="popup-btn">OK</button>
                </div>
            `;
            document.body.appendChild(popup);

            popup.querySelector(".popup-btn").addEventListener("click", () => {
                popup.remove();
            });
        }
            function sendData() {
                let name, roll, age, email, dob, gender;
                name = document.getElementById("name").value;
                roll = document.getElementById("roll").value;
                age = document.getElementById("age").value;
                email = document.getElementById("email").value;
                dob = document.getElementById("dob").value;
                gender = document.querySelector('input[name="gender"]:checked').value;
                // alert("hello");
                let data = {
                    name: name,
                    roll: roll,
                    age: age,
                    email: email,
                    dob: dob,
                    gender: gender
                }

                console.log("data : ", data);

                fetch("create.php", {
                    method: "POST",
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                    .then(res => { return res.text() })
                    .then(res => {
                        console.log("res : ", res);
                        showPopup(res);
                        displayData();
                    })
                    .catch(err => {
                        console.log("error in creating : ", err);
                    })
            }


            function displayData() {
                let name, roll, age, email, dob, gender;
                name = document.getElementById("name");
                roll = document.getElementById("roll");
                age = document.getElementById("age");
                email = document.getElementById("email");
                dob = document.getElementById("dob");
                fetch("read.php")
                    .then(res => { return res.json() })
                    .then(data => {
                        console.log("read : ", data);

                        if (data.message != undefined) {
                            console.log("fff : ", data.message);
                            document.getElementById("studentData").innerHTML = "";
                        } else {
                            let hed = data[0];
                            let heading = document.getElementById("hed");
                            let th, tr;
                            let body = document.getElementById("studentData");
                            body.innerHTML = "";
                            heading.innerHTML = "";
                            for (k in hed) {
                                th = document.createElement("th");
                                th.textContent = k;
                                heading.append(th);
                            }
                            th = document.createElement("th");
                            th.textContent = "Actions";
                            heading.append(th);

                            data.forEach(obj => {
                                tr = document.createElement("tr");
                                for (k in obj) {
                                    td = document.createElement("td");
                                    td.textContent = obj[k];
                                    tr.append(td);
                                }
                                td = document.createElement("td");
                                let btn = document.createElement("button");
                                btn.className = "action-btn";
                                let i = document.createElement("i");
                                i.className = "fas fa-edit";
                                btn.append(i);
                                btn.addEventListener("click", () => {
                                    name.value = obj.Name;
                                    roll.value = obj.Roll_no;
                                    age.value = obj.Age;
                                    email.value = obj.Email;
                                    dob.value = obj.DOB;
                                    roll.disabled = true;
                                    roll.style.cursor = "not-allowed";
                                    c.disabled = true;
                                    c.style.cursor = "not-allowed";
                                    d.disabled = true;
                                    d.style.cursor = "not-allowed";
                                    r.disabled = true;
                                    r.style.cursor = "not-allowed";
                                
                                });
                                    
                                td.append(btn);

                                btn = document.createElement("button");
                                btn.className = "action-btn";
                                i = document.createElement("i");
                                i.className = "fas fa-trash";
                                btn.append(i);
                                btn.addEventListener("click", () => {
                                    fetch("delete.php", {
                                        method: "POST",
                                        headers: {
                                            'content-type': 'application/json'
                                        },
                                        body: JSON.stringify({ roll: obj.Roll_no })
                                    })
                                        .then(res => { return res.text() })
                                        .then(res => {
                                            console.log("delete : ", res);
                                            showPopup(res);
                                            displayData();
                                        })
                                        .catch(err => {
                                            showPopup("Error in deleting");
                                            console.log("delete error : ", err);

                                        })
                                })
                                td.append(btn);
                                tr.append(td);
                                body.append(tr);
                            })
                        }
                    })
                    .catch(err => {
                        console.log("error in reading : ", err);
                    })
            }

             displayData();
            
    </script>
</body>

</html>