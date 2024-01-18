class XMLReq {
  constructor(url) {
    this.url = url;
  }

  #xmlreq(method, data = "") {
    let dataPromise = new Promise((res, rej) => {
      let xhr = new XMLHttpRequest();
      xhr.onload = () => {
        if (xhr.status == 200) {
          console.log(xhr);
          res(xhr.responseText);
        } else {
          rej(xhr.statusText);
        }
      };
      xhr.open(method, this.url);
      data != "" ? xhr.send(data) : xhr.send();
    });
    return dataPromise;
  }

  Post(data) {
    return this.#xmlreq("POST", data);
  }

  Get() {
    return this.#xmlreq("GET");
  }
}
//export
export default XMLReq;
