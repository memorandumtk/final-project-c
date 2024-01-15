class Staff {
    constructor(staff_id, fname, lname,email,pass,phone) {
        this.staff_id = staff_id;
        this.fname = fname;
        this.lname = lname;
        this.email = email;
        this.pass = pass;
        this.phone = phone;
    }

    toRow() {
        const tr = document.createElement('tr');
        for(let key in this){
            if (key !== "email" && key !== "pass"&& key !== "phone"){
                let td = document.createElement('td');
                td.textContent = this[key] ? this[key] : '---';
                tr.appendChild(td);
            }
        }
        return tr;
    }
}
export default Staff;