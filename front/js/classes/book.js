class Book {
    constructor(book_id, title, description, authors, registered_at, image_url, status, borrowed_at, due_back) {
        this.book_id = book_id;
        this.title = title;
        this.description = description;
        this.authors = authors;
        this.registered_at = registered_at;
        this.image_url = image_url;
        this.status = status;
        this.borrowed_at = borrowed_at;
        this.due_back = due_back;
    }

    toCard(){
        let cardCol = document.createElement('div');
        cardCol.classList.add('col');
        let card = document.createElement('div');
        card.classList.add('card');
        // card image, use image_url of the book.
        let cardImage = document.createElement('img');
        cardImage.classList.add('card-img-top');
        cardImage.alt = `${this.title}'s image.`;
        cardImage.src = this.image_url;

        // card body.
        let cardBody = document.createElement('div');
        cardBody.classList.add('card-body');
        // card title, which equals to title of book.
        let cardTitle = document.createElement('h5');
        cardTitle.classList.add('card-title');
        cardTitle.textContent = this.title;
        // author of the book.
        let authorText = document.createElement('p');
        authorText.classList.add('card-text');
        authorText.textContent = this.authors;
        // registered date of the book.
        let registeredText = document.createElement('p');
        registeredText.classList.add('card-text');
        registeredText.textContent = this.registered_at
        // Concatinating elements to card body.
        cardBody.append(cardTitle, authorText, registeredText);
        
        // Concatinating elements to card itself and to card col.
        card.append(cardImage, cardBody);
        cardCol.append(card);
        return cardCol;
    }


    toRow() {
        const tr = document.createElement('tr');
        for(let key in this){
            if (key !== "description" && key !== "image_url"){
                let td = document.createElement('td');
                td.textContent = this[key] ? this[key] : '---';
                tr.appendChild(td);
            }
        }
        return tr;
    }
}
export default Book;