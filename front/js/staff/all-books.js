
import XMLReq from "../XMLReq.js"
import Book from "../classes/book.js";
let staffPhp = "http://localhost/php/final-project-c/php/staff.php";
const allBookData = [];

const displayCardOfBook = () => {
    let cardsDiv = document.querySelector(".cards-div");
    for(let book of allBookData){
        let bookCard = book.toCard();
        cardsDiv.append(bookCard);
    }
}

// Function to get all of book data.
const getAllBookData = () => {
    // Apend path info to tell path in php.
    const allBookPath = staffPhp + "/all-books";
    // Making xmlhttp request to get all book data.
    let allBookRequest = new XMLReq(allBookPath);
    allBookRequest.Post().then(
        (data) => {
            let loadData;
            loadData = JSON.parse(data);
            for (let data of loadData) {
                let bookObj = new Book(data.book_id, data.title, data.description,data.authors, "", data.registered_at, data.image_url, "Available", null, null);
                allBookData.push(bookObj);
            }
            console.log(allBookData);
            displayCardOfBook()
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
