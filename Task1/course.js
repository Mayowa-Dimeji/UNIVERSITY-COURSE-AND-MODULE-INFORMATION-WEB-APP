//declare course data
let courses = [];

$(document).ready(function () {
  updateTable();
});

function updateTable() {
  setTimeout(function () {
    $.ajax({
      url: "course.json",
      type: "GET",
      dataType: "json",
      success: function (response) {
        courses = response.courses;
        let txt = "";
        $("#body").html("");
        $.each(courses, function (index) {
          txt +=
            "<tr><td>" +
            '<img class="icon" alt="Icon" src="' +
            courses[index].iconPath +
            '"/>' +
            courses[index].Title +
            "</td></tr>";
        });
        $("#body").append(txt);

        // begining of click event listener to display overlay
        $(document).on("click", "#body tr", function () {
          console.log("Click event listener set up.");
          document.getElementById("overlay").style.display = "none";

          // Get the index of the clicked row
          var index = $(this).index();
          //store fee list
          const gbpList = [];

          // Set the content to display in the overlay
          var icon =
            '<img class="icon" alt="Icon" src="' +
            courses[index].iconPath +
            '"/>';
          var courseTitle = "<h2>" + courses[index].Title + "</h2>";
          var overview =
            "<h3>Overview</h3>" + "<p>" + courses[index].Overview + "</p>";
          var highlights =
            "<h3>Highlights</h3>" + "<p>" + courses[index].Highlights + "</p>";
          var details =
            "<h3>Details</h3>" +
            "<p>" +
            courses[index].Contents.course_details +
            "</p>";
          var modules = "<h3>Module List</h3>" + "<ul>";
          for (var k = 0; k < courses[index].Contents.module_list.length; k++) {
            modules +=
              "<li>" + courses[index].Contents.module_list[k] + "</li>";
          }
          modules += "</ul>";
          var entry_reqs = "<h3>Entry Requirements</h3>" + "<ul>";
          for (var m = 0; m < courses[index].Entry_Requirements.length; m++) {
            entry_reqs +=
              "<li>" + courses[index].Entry_Requirements[m] + "</li>";
          }
          entry_reqs += "</ul>";
          var feesList = "<h3>Fees & Funding</h3><table class='secondTable'>";
          for (var key in courses[index].fees_and_funding) {
            if (courses[index].fees_and_funding.hasOwnProperty(key)) {
              feesList +=
                "<tr><td>" +
                key.replace(/_/g, " ") +
                "</td><td class='fees'>" +
                courses[index].fees_and_funding[key] +
                "</td></tr>";
              gbpList.push(courses[index].fees_and_funding[key]);
            }
          }
          feesList += "</table>";

          feesList += "</ul>";

          var faq = "<h4>FAQs</h4>" + "<p>" + courses[index].FAQs + "</p>";

          // get the overlay element
          var overlay = document.getElementById("overlay");

          //get divs from html and input set contents to the html
          var iconDiv = document.getElementById("iconOverlay");
          iconDiv.innerHTML = icon;

          var titleDiv = document.getElementById("titleOverlay");
          titleDiv.innerHTML = courseTitle;

          var overviewDiv = document.getElementById("overview");
          overviewDiv.innerHTML = overview;

          var highlightsDiv = document.getElementById("highlights");
          highlightsDiv.innerHTML = highlights;

          var detailsDiv = document.getElementById("details");
          detailsDiv.innerHTML = details;

          var modulesDiv = document.getElementById("moduleList");
          modulesDiv.innerHTML = modules;

          var entryDiv = document.getElementById("entryReq");
          entryDiv.innerHTML = entry_reqs;

          var feesDiv = document.getElementById("fees");
          feesDiv.innerHTML = feesList;

          var faqDiv = document.getElementById("faqs");
          faqDiv.innerHTML = faq;

          // Add the overlay to the body
          console.log("Overlay appended to the body.");

          overlay.style.display = "flex";
          overlay.classList.add("show");
          overlay.querySelector("#content").classList.add("scroll");
          console.log("Overlay appended to the body.");

          // click event listener to close button to hide it
          document
            .getElementById("closeBtn")
            .addEventListener("click", function () {
              document.getElementById("overlay").style.display = "none";
            });
          console.log(gbpList);

          //select listener
          const currencySelect = document.getElementById("my-select");

          // Add an event listener to the select element
          currencySelect.addEventListener("change", () => {
            const priceElements = document.querySelectorAll(".fees");
            // Get the selected option value
            const selectedCurrency = currencySelect.value;
            var clean = cleanList(gbpList);
            // Do something based on the selected option value
            if (selectedCurrency === "gbp") {
              // Call a function to convert from GBP to USD
              gbpList;
              priceElements.forEach((el, index) => {
                el.textContent = gbpList[index];
              });
            } else if (selectedCurrency === "usd") {
              // Call a function to convert from USD to GBP

              var list = formatList(gbpToUsd(clean), "$");
              priceElements.forEach((el, index) => {
                el.textContent = list[index];
              });
            } else if (selectedCurrency === "eur") {
              // Call a function to convert from EUR to GBP

              var list = formatList(gbpToEur(clean), "€");
              priceElements.forEach((el, index) => {
                el.textContent = list[index];
              });
            }
          });
        });
        // end of click event listener

        // const priceElements = document.querySelectorAll(".fees");
        // const priceValues = [];

        // priceElements.forEach((element) => {
        //   const priceText = element.textContent.trim();
        //   const priceValue = parseFloat(priceText.replace(/[£,]/g, ""));
        //   console.log(priceValue);
        // });
      },
      error: function () {
        $("#updatemessage").html("<p>An error has occurred</p>");
      },
    });
  }, 1);
}

//helper method for conversion
function gbpToUsd(values) {
  const exchangeRate = 1.41;
  const convertedValues = values.map((value) => value * exchangeRate);
  return convertedValues;
}

//helper method for conversion
function gbpToEur(values) {
  const exchangeRate = 1.16;
  const convertedValues = values.map((value) => value * exchangeRate);
  return convertedValues;
}
//helper method to return fees with proper symbol
function formatList(values, currency) {
  const formattedValues = values.map((value) => {
    const formattedValue = value.toLocaleString(undefined, {
      maximumFractionDigits: 2,
    });
    return `${currency}${formattedValue}`;
  });
  return formattedValues;
}
//helper method to clean fees list and parse to float
function cleanList(values) {
  const cleanedValues = values.map((value) => {
    const cleanedValue = value.replace(/[\s£,]/g, "");
    return parseFloat(cleanedValue);
  });
  return cleanedValues;
}
