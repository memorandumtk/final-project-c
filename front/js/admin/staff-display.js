
import XMLReq from "../XMLReq.js"
import Staff from "../classes/staff.js";
let adminPhp = "http://localhost/php/final-project-c/php/admin.php";
const staffList = [];



// Handle if delete button is clicked.
const deleteHandler = async (staff) => {
    // Apend path info to tell path in php.
    let deleteStaffPath = adminPhp + "/delete";
    // Making xmlhttp request to delete book info.
    let deleteStaffRequest = new XMLReq(deleteStaffPath);
    let reqData = new FormData();
    reqData.append("uid", staff.uid);
    try {
        let data = await deleteStaffRequest.Post(reqData);
        console.log(data);
        location.reload();
    } catch (rej) {
        console.log(rej);
    }
}









// Function to make a table having information of all of books.
const tablePopper = () => {
    const tbody = document.querySelectorAll('tbody')[0];
    for (let staff of staffList) {
        //toRow is method created in Staff class
        const tr = staff.toRow();
        // console.log(tr);
        const delTd = document.createElement('td');
        const delButton = document.createElement('button');
        delButton.textContent = 'Delete';
        delButton.classList.add('btn', 'btn-success')

     
       
        delButton.addEventListener('click', (e) => {
            e.preventDefault();
            deleteHandler(staff);
        });
        delTd.appendChild(delButton);
        tr.appendChild(delTd);
        tbody.appendChild(tr);
    }


}

const staffData = async () => {
    let path = adminPhp + "/staff";
    let staffInfoRequest = new XMLReq(path);
    try {
        // send request and stored data
        let data = await staffInfoRequest.Post();
        //parse=json string to json object
        data = (JSON.parse(data));
        // console.log(data);

        //data= all of the staff data,staff
        for (let staff of data) {
            let staffObj = new Staff(staff.uid, staff.fname, staff.lname, staff.email, staff.pass, staff.phone);
            staffList.push(staffObj);
            console.log(staffList);
        }

    } catch (rej) {
        console.log(rej);
    }
}

// Modify load function to use async/await
async function load() {
    // Since 'getBorrowedStatus' function is using promise, so I needed to use await as well.
    await staffData();
    tablePopper();
}
load();

// add staff
function redirectToRegisterPage() {
    window.location.href = "http://localhost/php/final-project-c/front/registerSa.html";
}