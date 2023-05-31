const selectedOptions = new Set();
$(document).ready(function () {
  // Add Module button functionality for more than one module
  $("#addModuleButton").click(function () {
    const moduleInput = `
            <div class="module-input">
                <input type="text" name="module[]" placeholder="Module Name">
                <input type="text" name="credit[]" placeholder="Credit" pattern="[0-9]+" title="Please enter a number">
            </div>`;
    $("#modulesContainer").append(moduleInput);
  });

  // Add Fee button functionality
  $("#addFeeButton").click(function () {
    const feeInput = `
          <div class="fee-input">
              <select name="feesType[]">
              <option value="option1">Uk Full Time</option>
              <option value="option2">Uk part time</option>
              <option value="option3">Uk foundation</option>
              <option value="option4">International Full time</option>
              <option value="option5">International Part time</option>
              <option value="option5">International Foundation</option>
              <option value="option5">Work Placement</option>
              </select>
              <input type="text" name="figure[]" placeholder="Figure" pattern="[0-9]+" title="Please enter a number">
          </div>`;
    $("#feesContainer").append(feeInput);
  });

  //disable select options clicked already
  const selectElement = document.getElementById("mySelect");

  selectElement.addEventListener("change", function () {
    const selectedOption = this.value;

    if (selectedOption !== "") {
      const options = this.getElementsByTagName("option");

      for (let i = 0; i < options.length; i++) {
        if (options[i].value === selectedOption) {
          options[i].disabled = true;
        }
      }
    }
  });
});
