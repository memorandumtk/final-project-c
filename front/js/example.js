import {XMLReq} from "./XMLReq.js";
let xmlReq = new XMLReq("http://localhost/final-project-c/index.php");
let reqData = new FormData();
// This method is used to throw a request.
xmlReq.Post(reqData).then(
    (data) => {
        // You can do anything with the data.
        alert(data);
    },
    (rej) => {
        console.log(rej);
    }
)