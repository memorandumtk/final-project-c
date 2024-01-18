class Staff {
    constructor(uid, fname, lname,email,pass,phone) {
        this.uid = uid;
        this.fname = fname;
        this.lname = lname;
        this.email = email;
        this.pass = pass;
        this.phone = phone;
    }

    toRow() {
        const tr = document.createElement('tr');
        for(let key in this){
            if (key !== "pass"){
                let td = document.createElement('td');
                td.textContent = this[key] ? this[key] : '---';
                tr.appendChild(td);
            }
        }
        return tr;
    }
}
export default Staff;