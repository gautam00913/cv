import 'https://kit.fontawesome.com/7fd20e3bd7.js';

    initCountry().then(function(result) {
        if(result.IP){
            const date = new Date();
            const data = {
                ip_address: result.IP,
                country_code: result.countryCode,
                uag: result.uag,
                date: date.toISOString()
            };

            fetch('/visits', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify(data) 
            })
            .then(response => response.json())
            .then(result => console.log(result))
            .catch(error => console.log(error))
            
        }
    } ).catch(e => console.log(e));
    //automatic country determination.
    function initCountry() {
        return new Promise((resolve, reject) => {
            var xhr = new XMLHttpRequest();
            xhr.timeout = 3000;
            xhr.onreadystatechange = function () {
                if (this.readyState == 4) {
                    if (this.status == 200) {
                        //regular expressions to extract IP and country values
                        const countryCodeExpression = /loc=([\w]{2})/;
                        const userIPExpression = /ip=([\w\.]+)/;
                        const userDeviseExpression = /uag=([^\n]+)/;
                        let countryCode = countryCodeExpression.exec(this.responseText)
                        let ip = userIPExpression.exec(this.responseText)
                        let devise = userDeviseExpression.exec(this.responseText)
                        
                        if (countryCode === null || countryCode[1] === '' ||
                            ip === null || ip[1] === '') {
                            reject('IP/Country code detection failed');
                        }
                        let result = {
                            "countryCode": countryCode[1],
                            "IP": ip[1],
                            "uag": devise[1],
                        };
                        resolve(result)
                    } else {
                        reject(xhr.status)
                    }
                }
            }
            xhr.ontimeout = function () {
                reject('timeout')
            }
            xhr.open('GET', 'https://www.cloudflare.com/cdn-cgi/trace', true);
            xhr.send();
        });
    }