# 🧃 Yuka Clone – Voedingswaarden opzoeken via barcode

> 🎓 GIP-project 2024–2025 – Provil | ICW6  
> 👨‍💻 Gerealiseerd door: Tuur Verweyen & Mees van der Heijden  
> 🎯 Doel: Een toegankelijke webtool ontwikkelen waarmee gebruikers barcodes kunnen scannen en voedingsinformatie kunnen opvragen

---

## 📖 Over het project

We wilden met dit project het dagelijks leven van mensen gezonder en makkelijker maken. Daarom ontwikkelden we een eenvoudige, maar krachtige website waarmee gebruikers barcodes van voedingsproducten kunnen scannen of invoeren om direct inzicht te krijgen in de voedingswaarden van dat product.

De website maakt gebruik van de [OpenFoodFacts API](https://world.openfoodfacts.org/data), een open database met informatie over duizenden producten wereldwijd. We hebben daarnaast een visuele beoordelingssysteem toegevoegd, zodat gebruikers in één oogopslag zien of een product gezond is of niet.

---

## ❓ Probleemstelling

Veel mensen vinden het lastig om snel en duidelijk voedingswaarden op verpakkingen te begrijpen. Apps zoals Yuka bieden hier een oplossing, maar niet iedereen wil een app downloaden of registreren.

Ons doel was daarom om:

- 📷 Een webtool te maken die zonder installatie werkt
- 🔎 Barcode-invoer én -scanning toe te voegen
- 📊 Voedingsinformatie overzichtelijk weer te geven
- ✅ Een gezondheidsscore toe te kennen op basis van ingrediënten

---

## 🧠 Plan van Aanpak

1. **Structuur opzetten** – basis HTML-structuur voor invoerveld, scanner en resultaat
2. **API-koppeling bouwen** – via PHP en JS communiceren met OpenFoodFacts
3. **Database integreren** – gescande producten opslaan per gebruiker
4. **Inlog/registreersysteem ontwikkelen**
5. **Gezondheidsscore berekenen en visueel tonen**
6. **Styling & mobile responsive maken**

---

## 🧰 Hardware & Software

| Technologie        | Toelichting                                                   |
|--------------------|----------------------------------------------------------------|
| **HTML & CSS**     | Structuur & styling van de interface                          |
| **PHP**            | Inlogfunctionaliteit en verwerking van zoekopdrachten          |
| **JavaScript (JS)**| Voor interactieve elementen en API-aanroepen                   |
| **MySQL Database** | Opslag van gebruikersgegevens en gescande producten            |
| **OpenFoodFacts API** | Levert productdata zoals ingrediënten, nutri-scores en labels |

---

## 🛠️ Realisatie

We startten met een eenvoudige zoekpagina waar gebruikers een barcode konden ingeven. Deze barcode wordt via JavaScript naar een PHP-script gestuurd, dat op zijn beurt een API-aanroep doet naar OpenFoodFacts.

De resultaten worden weergegeven in een duidelijke kaart met:

- Naam van het product
- Nutri-score of gezondheidsscore (visueel aangeduid)
- Belangrijke ingrediënten en voedingswaarden
- Productafbeelding (indien beschikbaar)

Daarnaast bouwden we een login/registreersysteem zodat gebruikers hun scanhistoriek kunnen bijhouden. Elke gescande barcode wordt aan hun account gekoppeld in de database.

---

## ✅ Besluit

Met dit project hebben we een toegankelijke en gebruiksvriendelijke website ontwikkeld die mensen helpt om op een snelle manier voedingsinformatie van producten op te zoeken.  

Door gebruik te maken van een barcodescanner en de OpenFoodFacts-database, hebben we het probleem van moeilijk leesbare etiketten opgelost met een digitale oplossing.  
Het is een modern, praktisch alternatief voor wie geen app wil downloaden, maar toch snel inzicht wil in wat er in een product zit.

Dit project gaf ons een goed inzicht in webontwikkeling, API-integraties en het bouwen van een praktische tool die mensen echt helpt.

---
