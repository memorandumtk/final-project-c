
import XMLReq from "../XMLReq.js"
import Book from "../classes/book.js";
let staffPhp = "http://localhost/php/final-project-c/php/staff.php";
const allBookData = [];

// Function to send new book data from a form.
const addBookData = async (e) => {
    // Apend path info to tell path in php.
    const addBookPath = staffPhp + "/add-book";
    // Take data input from form.
    let reqData = new FormData(e.target);
    try {
        // Making xmlhttp request to send new book data and send it.
        let addBookRequest = new XMLReq(addBookPath);
        let data = await addBookRequest.Post(reqData);
        alert(data);
        // Navigate the user to all book page.
        location.replace('http://localhost/php/final-project-c/front/staff/all-books.html');
    } catch (rej) {
        console.log(rej);
    }
}

const bookAddForm = document.querySelector("#book-add-form");
bookAddForm.addEventListener('submit', (e) => {
    e.preventDefault();
    addBookData(e);
})

