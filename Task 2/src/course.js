//declare course variable
let courses;

function updateTable() {
  setTimeout(function () {
    $.ajax({
      url: "courseSelectionForm.php",
      type: "GET",
      dataType: "json",
      success: function (response) {
        courses = response; // store course data response
        $("#tbody").empty();
        // console.log("hi");

        // Iterate over the courses array and display on html table
        $.each(courses, function (index, course) {
          var courseId = course.course_id;
          // console.log(courseId);
          var iconPath = course.iconPath;
          var title = course.title;
          var level = course.level;

          // <img src="${iconPath}" alt="icon" />

          // Generate the HTML for each row
          var rowHtml = `
                    <tr>
                      <td><input type="checkbox" class="course-checkbox" id="course${courseId}" /></td>
                      <td><span>i</span></td>
                      <td>${title}</td>
                      <td>${level}</td>
                      <td>
                        <button class="show-more">...</button>
                      </td>
                    </tr>
                  `;

          // Append the row HTML to the table body
          $("#tbody").append(rowHtml);

          //to display the overlay for more information when show more button is clicked
          $(document).on("click", "#tbody .show-more", function () {
            document.getElementById("overlay").style.display = "none";
            var index = $(this).closest("tr").index();
            const gbpList = []; // for collecting array of fees
            console.log(index);

            //format HTML display of information then set to inener html

            var courseTitle = "<h2>" + courses[index].title + "</h2>"; //title
            document.getElementById("titleOverlay").innerHTML = courseTitle;

            var overviewO =
              "<h3>Overview</h3>" + "<p>" + courses[index].overview + "</p>";
            document.getElementById("overviewOverlay").innerHTML = overviewO; //overview

            var highlightsO =
              "<h3>Highlights</h3>" +
              "<p>" +
              courses[index].highlights +
              "</p>";
            document.getElementById("highlightsOverlay").innerHTML = //highlights
              highlightsO;

            var detailsO =
              "<h3>Details</h3>" +
              "<p>" +
              courses[index].course_details +
              "</p>";
            document.getElementById("detailsOverlay").innerHTML = detailsO; //details

            var entryReq =
              "<h3><h3>Entry Requirements</h3></h3>" +
              "<p>" +
              courses[index].entry_requirements +
              "</p>";
            document.getElementById("entryReqOverlay").innerHTML = entryReq; //entry requirements

            var faqs = "<h4>FAQs</h4>" + "<p>" + courses[index].faq + "</p>";
            document.getElementById("faqs").innerHTML = faqs; //faqs

            var modulesList = "<h3>Module List</h3><table>";
            modulesList += "<tr><th>Name</th><th>Credit</th></tr>";
            for (var k = 0; k < courses[index].modules.length; k++) {
              modulesList +=
                "<tr><td>" +
                courses[index].modules[k].name +
                "</td><td>" +
                courses[index].modules[k].credit +
                "</td></tr>";
            }
            modulesList += "</table>";

            document.getElementById("moduleListOverlay").innerHTML =
              modulesList;

            //for fees, we want to get only rows fromn select rows that are not empty to display in overlay
            var columnNames = [
              "fees_uk_full_time",
              "fees_uk_part_time",
              "fees_uk_integrated_foundation_year",
              "fees_international_integrated_foundation_year",
              "fee_international_full",
              "fee_international_part",
              "fees_optional_work_placement_year",
            ];
            var nonNullColumns = [];

            // Iterate through the specified column names
            for (var i = 0; i < columnNames.length; i++) {
              var columnName = columnNames[i];

              if (
                courses[index].hasOwnProperty(columnName) &&
                courses[index][columnName] !== "NULL"
              ) {
                nonNullColumns.push(columnName);
              }
            }
            // Display the non-null columns in a table

            var feeList = "<table>";
            for (var j = 0; j < nonNullColumns.length; j++) {
              feeList +=
                "<tr><td>" +
                nonNullColumns[j].replace(/_/g, " ") +
                "</td><td class='fees'>" +
                courses[index][nonNullColumns[j]] +
                "</td></tr>";

              gbpList.push(courses[index][nonNullColumns[j]]);
            }
            feeList += "</table>";
            document.getElementById("fees").innerHTML = feeList;
            //show overlay
            // console.log(gbpList);

            overlay.style.display = "flex";
            overlay.querySelector("#content").classList.add("scroll");
            // click event listener to close button to hide overlay
            document
              .getElementById("closeBtn")
              .addEventListener("click", function () {
                document.getElementById("overlay").style.display = "none";
              });

            //select listener
            const currencySelect = document.getElementById("my-select");

            // Add an event listener to the select element
            currencySelect.addEventListener("change", () => {
              const priceElements = document.querySelectorAll(".fees"); //collect fees on the column
              // Get the selected option value
              const selectedCurrency = currencySelect.value;
              var clean = cleanList(gbpList); //clean list to float numbers

              if (selectedCurrency === "gbp") {
                // append fees in Gbp
                gbpList;
                priceElements.forEach((el, index) => {
                  el.textContent = gbpList[index];
                });
              } else if (selectedCurrency === "usd") {
                // Call the function to convert and display fees in USD

                var list = formatList(gbpToUsd(clean), "$");
                priceElements.forEach((el, index) => {
                  el.textContent = list[index];
                });
              } else if (selectedCurrency === "eur") {
                // Call the function to convert and display fees in EUR

                var list = formatList(gbpToEur(clean), "€");
                priceElements.forEach((el, index) => {
                  el.textContent = list[index];
                });
              }
            });
          });

          //if check box in header is checked, check all others
          $(document).on("change", "#checkAll", function () {
            $("table")
              .find('input[type="checkbox"]')
              .prop("checked", this.checked);
          });

          // for course report
        });
        handleCheckboxSelection(courses);
        // $(document).on("click", "#createReportBtn", function () {
        //   console.log("im clickerrr");
        //   //check for all check boxes
        //   let selectedCourses = [];
        //   const checkboxes = document.getElementsByClassName("course-checkbox");
        //   console.log(checkboxes.length);
        //   //get relevant courses to array
        //   //parse as json data  localStorage.setItem('selectedCheckboxes', JSON.stringify(selectedCheckboxes));
        // });
      },
      error: function () {
        $("#updatemessage").html("<p>An error has occurred</p>");
      },
    });
  }, 1);
}
function handleCheckboxSelection(coursess) {
  // Get checkboxes after the AJAX request completes
  $(document).on("click", "#createReportBtn", function () {
    const checkboxes = document.getElementsByClassName("course-checkbox");
    const selectedCourses = [];

    // Iterate over the checkboxes
    for (let i = 0; i < checkboxes.length; i++) {
      const checkbox = checkboxes[i];

      // Check if the checkbox is checked
      if (checkbox.checked) {
        const index = $(checkbox).closest("tr").index();

        // Check if the index is valid and retrieve the corresponding course
        if (index >= 0 && index < coursess.length) {
          const course = coursess[index];
          selectedCourses.push(course);
        }
      }
    }
    if (selectedCourses.length === 0) {
      // Display an error message or perform any desired action
      console.log("No courses selected.");
      return; // Exit the function early if no courses are selected
    }
    // Log the selected courses
    localStorage.setItem("chartCourses", JSON.stringify(selectedCourses));
    console.log(selectedCourses.length);
  });
}
//on document ready call update table function
$(document).ready(function () {
  updateTable();
});

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
//helper method to return fees with proper symbol and comma
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
