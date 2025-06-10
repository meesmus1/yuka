let scanHistory = [];
let scanning = false;
const codeReader = new ZXing.BrowserMultiFormatReader();

$(document).ready(function() {
    showScan();
});

function startScanner() {
    const button = document.getElementById("historybutton");

    // Controleer of de codeReader al bestaat, zo niet, maak een nieuwe aan
    if (!codeReader) {
        codeReader = new ZXing.BrowserMultiFormatReader();
    }

    if (scanning) {
        // Scanner stoppen
        scanning = false;
        button.innerText = "Start Scanning";
        codeReader.reset(); // Stopt de camera
    } else {
        // Scanner starten
        scanning = true;
        button.innerText = "Stop Scanning";

        codeReader.decodeFromVideoDevice(undefined, 'scanner-container', (result, err) => {
            if (result) {
                document.getElementById("result").innerText = result.text;
                fetchProductInfo(result.text);

                // Stop de scanner na een succesvolle scan
                if (scanning) {
                    scanning = false;
                    button.innerText = "Start Scanning";
                    codeReader.reset();
                }
            }
            if (err && !(err instanceof ZXing.NotFoundException)) {
                console.error(err); // Toon fouten behalve 'Not Found'
            }
        }).catch(err => console.error("Camera toegang mislukt:", err));
    }
}

function fetchProductInfo(barcode) {
    $.get(`https://world.openfoodfacts.org/api/v2/product/${barcode}.json`, function(response) {
        if (response.product) {
            let product = response.product;
            let productName = product.product_name || "No name available";
            let productImage = product.image_url || "";
            let nutriScore = product.nutrition_grades || "N/A";
            let sugarContent = product.nutriments.sugars ? Math.round(product.nutriments.sugars) : "N/A";
            let energy = product.nutriments["energy-kcal"] ? Math.round(product.nutriments["energy-kcal"]) : "N/A";
            let protein = product.nutriments.proteins ? Math.round(product.nutriments.proteins) : "N/A";
            let fiber = product.nutriments.fiber ? Math.round(product.nutriments.fiber) : "N/A";
            let saturatedFat = product.nutriments["saturated-fat"] ? Math.round(product.nutriments["saturated-fat"]) : "N/A";
            let salt = product.nutriments.salt ? Math.round(product.nutriments.salt) : "N/A";
            let negatives = product.ingredients_analysis_tags?.join(", ") || "N/A";
            let score = product.nova_group ? product.nova_group * 25 : "N/A";
            
            let sugarLevelClass = sugarContent !== "N/A" && sugarContent < 5 ? "low" 
                                  : sugarContent < 15 ? "medium" 
                                  : "high";
            

            // Save the scanned product
            save(productName, productImage, nutriScore, sugarContent, energy, protein, fiber, saturatedFat, salt, negatives, score, sugarLevelClass);

            scanHistory.push({
                name: productName,
                barcode,
                show: () => showModal(productName, productImage, nutriScore, sugarContent, energy, protein, fiber, saturatedFat, salt, negatives, score, sugarLevelClass)
            });

            updateHistory();
        }
    });
}

function updateHistory() {
    let historyHtml = scanHistory.map((item, index) => `
        <div class="history-item">
            <span>${item.name}</span>
            <button onclick="scanHistory[${index}].show()" >View</button>
        </div>
    `).join("");
    $("#history-list").html(historyHtml);
}

// function showModal(name, image, nutriScore, sugar, energy, protein, fiber, fat, salt, negatives, score, sugarLevelClass) {
//     let modalHtml = `
//         <div id="product-modal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); display: flex; justify-content: center; align-items: center;">
//             <div style="background: white; padding: 20px; border-radius: 10px; width: 90%; max-width: 400px; text-align: center;">
//                 <h2>${name}</h2>
//                 <img src="${image}" alt="Product Image" style="width: 100px; height: auto; margin: 10px auto;">
//                 <p>Nutri-Score: ${nutriScore.toUpperCase()}</p>
//                 <p>Energy: ${energy} kcal</p>
//                 <p>Protein: ${protein}g</p>
//                 <p>Fiber: ${fiber}g</p>
//                 <p>Sugar: <span class="sugar-level ${sugarLevelClass}">${sugar}g</span></p>
//                 <p>Saturated Fat: ${fat}g</p>
//                 <p>Salt: ${salt}g</p>
//                 <p>Negatives: ${negatives}</p>
//                 <p>Score: ${score}/100</p>
//                 <button onclick="document.getElementById('product-modal').remove()">Close</button>
//             </div>
//         </div>
//     `;
//     $("body").append(modalHtml);
// }

function save(name, image, nutriScore, sugar, energy, protein, fiber, fat, salt, negatives, score, sugarLevelClass) {
    $.ajax({
        url: "./includes/saveScan.php",
        data: {
            name,
            image,
            nutriScore,
            energy,
            protein,
            fiber,
            sugarLevelClass,
            sugar,
            fat,
            salt,
            negatives,
            score
        },
        method: "POST",
        dataType: 'json',
        success: function(data) {
            console.log(data);
        }
    });
}

function showScan() {
    $.ajax({
        url: "./includes/showScan.php",
        data: {},
        method: "POST",
        dataType: 'json',
        success: function(data) {
            console.log(data);
            $('#history-list').html(data);

        }
    });
}
