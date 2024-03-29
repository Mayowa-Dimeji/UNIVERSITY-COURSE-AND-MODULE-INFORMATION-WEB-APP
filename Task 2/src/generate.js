$(document).ready(function () {
  //   console.log(courses);
  const selectedCheckboxes = JSON.parse(localStorage.getItem("chartCourses")); //get check courses stored in course.js
  // console.log(selectedCheckboxes.length);
  if (selectedCheckboxes.length == 1) {
    //plot one pie chart if its one item and append table
    const course = selectedCheckboxes[0];
    //table information
    var myTable = document.createElement("table");
    var tableHTML = `<thead>
                    <tr>
                        <th>Title</th>
                        <th>Level</th>
                    </tr>
                </thead>
                <tbody>`;
    tableHTML += `<tr>
                <td>${course.title}</td>
                <td>${course.level}</td>
            </tr>`;
    tableHTML += `</tbody>`;

    // Set the HTML string as the content of the table element
    myTable.innerHTML = tableHTML;
    var container = document.getElementById("pieContainer");
    var oneDiv = document.createElement("div");
    var myCanvas = document.createElement("canvas");
    myCanvas.id = "pie1";
    oneDiv.classList.add("myClass");
    oneDiv.appendChild(myTable);
    oneDiv.appendChild(myCanvas);
    container.appendChild(oneDiv);

    setPieChart(course.modules, document.getElementById("pie1"));
  } else if (selectedCheckboxes.length > 1) {
    //if more than one course
    for (var i = 0; i < selectedCheckboxes.length; i++) {
      const course = selectedCheckboxes[i];

      // Create table for each course
      var myTable = document.createElement("table");
      var tableHTML = `<thead>
                            <tr>
                                <th>Title</th>
                                <th>Level</th>
                            </tr>
                        </thead>
                        <tbody>`;
      tableHTML += `<tr>
                        <td>${course.title}</td>
                        <td>${course.level}</td>
                    </tr>`;
      tableHTML += `</tbody>`;

      myTable.innerHTML = tableHTML;

      // Create canvas element for eacch course chart
      var myCanvas = document.createElement("canvas");
      myCanvas.id = "pie" + (i + 1);

      // get container div and append table and canvas
      var container = document.getElementById("pieContainer");
      var oneDiv = document.createElement("div");
      oneDiv.classList.add("myClass"); //for css styling
      oneDiv.appendChild(myTable);
      oneDiv.appendChild(myCanvas);
      container.appendChild(oneDiv);

      // Generate chart for course
      setPieChart(course.modules, myCanvas);
    }
    setBarChart(selectedCheckboxes); //set up bar chart
  }
});

//create pie chart
function setPieChart(modules, canvas) {
  console.log("in new chart");
  const type = "pie";

  const randomColor = () => {
    const r = Math.floor(Math.random() * 256);
    const g = Math.floor(Math.random() * 256);
    const b = Math.floor(Math.random() * 256);
    return `rgba(${r}, ${g}, ${b}, 0.2)`;
  };

  const randomBorderColor = () => {
    const r = Math.floor(Math.random() * 256);
    const g = Math.floor(Math.random() * 256);
    const b = Math.floor(Math.random() * 256);
    return `rgba(${r}, ${g}, ${b}, 1)`;
  };

  const data = {
    labels: modules.map((module) => module.name),
    datasets: [
      {
        label: "Credits",
        data: modules.map((module) => module.credit),
        backgroundColor: modules.map(() => randomColor()),
        borderColor: modules.map(() => randomBorderColor()),
        borderWidth: 1,
      },
    ],
  };

  const options = {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  };
  console.log("555");
  return new Chart(canvas, {
    type: type,
    data: data,
    options: options,
  });
}

//bar chart setup
function setBarChart(courses) {
  // Retrieve the canvas element
  const canvas = document.getElementById("comparisonChart");
  const ctx = canvas.getContext("2d");

  // Prepare data for the chart
  const chartData = {
    labels: [],
    datasets: [],
  };

  // Extract module data
  courses.forEach((course) => {
    const courseModules = course.modules.map((module) => module.credit);
    chartData.labels.push(course.title);
    chartData.datasets.push({
      label: course.title,
      data: courseModules,
      borderWidth: 1,
    });
  });

  // create bar chart
  new Chart(ctx, {
    type: "bar",
    data: chartData,
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
}
