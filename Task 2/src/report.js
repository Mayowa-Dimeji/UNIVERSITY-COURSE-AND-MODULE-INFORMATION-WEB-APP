//for generate report button
$(document).on("click", "#createReportBtn", function () {
  let selectedCourses = [];
  const checkboxes = document.getElementsByClassName("course-checkbox");

  // Iterate over the checkboxes to check the selection
  // Iterate over the checkboxes to check the selection
  for (let i = 0; i < checkboxes.length; i++) {
    const checkbox = checkboxes[i];
    if (checkbox.checked) {
      const courseId = parseInt(checkbox.id.replace("course", ""), 10);
      const course = courses.find((course) => course.course_id == courseId);
      if (course) {
        selectedCourses.push(course);
      }
    }
  }

  console.log(selectedCourses.length);
  //

  if (selectedCourses.length == 0) {
    // alert("Please select at least one course.");
    containerDiv.innerHTML = "<p>i<p>";
  } else if (selectedCourses.length == 1) {
    var chart; // global variable to keep reference to the chart

    // ...

    if (chart) {
      // if chart is not undefined or null
      chart.destroy(); // destroy the old chart
    }

    chart = new Chart(document.getElementById("myChart"), {
      type: "bar",
      data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [
          {
            label: "# of Votes",
            data: [12, 19, 3, 5, 2, 3],
            borderWidth: 1,
          },
        ],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    });
    window.open("./sampleCourseReport.php", "_blank");
  }
  // else {
  // }
});
