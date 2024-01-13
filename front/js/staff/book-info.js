
import XMLReq from "../XMLReq.js"
import Book from "../classes/book.js";
let staffPhp = "http://localhost/final-project-c/php/staff.php";
const allBookData = [];
const allBookObjData = [];

// Add event listener to the button to add a book
const addButton = document.querySelector("#addButton");
addButton.addEventListener('click', (e) => {
    location.replace('http://localhost/final-project-c/front/staff/add-book.html');
})

// Handle if delete button is clicked.
const deleteHandler = async (book) => {
    console.log(book);
    // Apend path info to tell path in php.
    let deleteBookPath = staffPhp + "/delete";
    // Making xmlhttp request to delete book info.
    let deleteBookRequest = new XMLReq(deleteBookPath);
    let reqData = new FormData();
    reqData.append("book_id", book.book_id);
    try {
        let data = await deleteBookRequest.Post(reqData);
        console.log(data);
        location.reload();
    } catch (rej) {
        console.log(rej);
    }
}

// Function to make a table having information of all of books.
const tablePopper = () => {
    const tbody = document.querySelectorAll('tbody')[0];
    for (let book of allBookObjData) {
        const tr = book.toRow();
        const delTd = document.createElement('td');
        const delButton = document.createElement('button');
        delButton.textContent = 'Delete';
        delButton.classList.add('btn', 'btn-success')
        // Unless status is Available, button should be disabled.
        if(book.status !== 'Available'){
            delButton.disabled = true;
        }
        delButton.addEventListener('click', (e)=> {
            e.preventDefault();
            deleteHandler(book);
        })
        delTd.appendChild(delButton);
        tr.appendChild(delTd);
        tbody.appendChild(tr);
    }
}

// Function to get all of book data.
const getBorrowedStatus = async (book) => {
    // Apend path info to tell path in php.
    let statusOfBookPath = staffPhp + "/status";
    // Making xmlhttp request to status of book.
    let statusOfBookRequest = new XMLReq(statusOfBookPath);
    let reqData = new FormData();
    reqData.append("book_id", book.book_id);
    try {
        let data = await statusOfBookRequest.Post(reqData);
        // Add data from `book_status_tb` and create book object by Book class.
        book.status = (!data) ? 'Available' : 'Borrowed';
        book.borrowed_at = (!data) ? null : JSON.parse(data).borrowed_at;
        book.due_back = (!data) ? null : JSON.parse(data).due_back;
        let bookObj = new Book(book.book_id, book.title, book.description, book.authors, book.registered_at, book.image_url, book.status, book.borrowed_at, book.due_back);
        // After making book object, push it to the array for book obj.
        allBookObjData.push(bookObj);
    } catch (rej) {
        console.log(rej);
    }
}

// Function to get all of book data.
const getAllBookData = async () => {
    // Apend path info to tell path in php.
    let allBookPath = staffPhp + "/all-books";
    // Making xmlhttp request to get all book data.
    let allBookRequest = new XMLReq(allBookPath);
    try {
        let data = await allBookRequest.Post();
        let loadData = JSON.parse(data);
        for (let data of loadData) {
            allBookData.push(data);
        }
        console.log('this is log from all books');
        console.log(allBookData);
    } catch (rej) {
        console.log(rej);
    }
}

// Modify load function to use async/await
async function load() {
    // Since 'getAllBookData' function is using promise, so I needed to use await.
    await getAllBookData();
    for (let book of allBookData) {
        // Since 'getBorrowedStatus' function is using promise, so I needed to use await as well.
        await getBorrowedStatus(book);
    }
    console.log(allBookObjData);
    tablePopper();
}
load();