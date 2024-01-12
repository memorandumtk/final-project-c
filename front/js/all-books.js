
import XMLReq from "../js/XMLReq.js"
let staffPhp = "http://localhost/final-project-c/php/staff.php";
let allBookData = [];

// Function to get all of book data.
const getAllBookData = () => {
    // Apend path info to tell path in php.
    staffPhp += "/all-books";
    // Making xmlhttp request to get all book data.
    let allBookRequest = new XMLReq(staffPhp);
    allBookRequest.Post().then(
        (data) => {
            allBookData = JSON.parse(data);
            console.log(allBookData);
        },
        (rej) => {
            console.log(rej);
        }
    )
}

function load() {
    getAllBookData();
}
load();
