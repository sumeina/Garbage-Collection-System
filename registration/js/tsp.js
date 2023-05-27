
// tsp.js

var addresses = [];
var myLatitudes = [];
var newLatitudes = [];
var distancesInMetres = 0;

function calculateDistance(initial = [1, 1], final = [2, 2]) {
  let diff = (final[0] - initial[0]) * 1 + (final[1] - initial[1]) * 1;
  //console.log(`Diffe: ${diff}`);
  return Math.abs(diff);
}
function initGraph(graphs = [[]]) {
  let temp = [];
  for (let i = 0; i < graphs.length; i++) {
    temp[i] = [];
    for (let j = 0; j < graphs.length; j++) {
      if (i == j) {
        temp[i][j] = 0;
      } else {
        temp[i][j] = calculateDistance(graphs[i], graphs[j]);
      }
    }
  }
  
  return temp;
}

const travellingSalesmanProblem = (graph = [], s) => {
   // Initialize an array to store the latitudes and longitudes
   let latLngArray = [];

  let vertex = [];
  for (let i = 0; i < graph.length; i++) {
    if (i !== s) {
      vertex.push(i);
    }
  }

  let min_path = Number.MAX_VALUE;
  //variable called path, starting vertex s....
  let path = s; // Declare the path variable here
  do {
    // store current Path weight(cost)
    let current_pathweight = 0;
    let current_path = [s]; //,,,,
   
    // compute current path weight
    let k = s;

    for (let i = 0; i < vertex.length; i++) {
      current_path.push(vertex[i]);
      current_pathweight += graph[k][vertex[i]];
      k = vertex[i];
    }
    current_path.push(s);

    current_pathweight += graph[k][s];
    if(min_path>=current_pathweight){
       min_path=current_pathweight;
        path = current_path;
     // Store the latitudes and longitudes in the same order as the path
     latLngArray = current_path.map((vertex) => graph[vertex]);
    }
  } while (findNextPermutation(vertex));
  console.log("path", path)
  let rootPath = [];
  for(i=0; i<path.length; i++) {
    let key = path[i];
    rootPath[i] = addresses[key];
    newLatitudes[i] = myLatitudes[key];
  }

  let map = L.map('map').setView([51.505, -0.09], 13);
  
  const distanceElement = document.getElementById("distance");

  for(i = 0; i < newLatitudes.length; i++) {
    if(i > 0) {
      // Add a tile layer (you can use your preferred tile provider)
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 18
      }).addTo(map);

      // Create a routing control instance
      var routingControl = L.Routing.control({
        waypoints: [
          L.latLng(newLatitudes[i]), // Example waypoint 1
          L.latLng(newLatitudes[i-1]) // Example waypoint 2
        ]
      }).addTo(map);

      routingControl.on('routeselected', function(e) {
        var route = e.route;
        distancesInMetres += route.summary.totalDistance; // Total distance in meters
        console.log('Total distance:', distancesInMetres, 'meters');
        distanceElement.innerHTML = `<strong>Distance: </strong> ${parseInt(distancesInMetres)} M`;
        
      });
    } 
  }
  let pathString = rootPath.join(" -> ");
  console.log("Shortest path:", pathString);
  console.log("Shortest path:", path.join(" -> "), );
path.forEach((vertex) => {
  const [lat, lng] = graph[vertex];
  console.log(`[${lat}, ${lng}]`);
  
});
  const output = document.getElementById("weight"); 
  output.innerHTML = `<strong>Shortest path: </strong> ${pathString}`;
  return min_path;
};
const swap = (data, left, right) => {
  // Swap the data
  let temp = data[left];
  data[left] = data[right];
  data[right] = temp;

  return data;
};

const reverse = (data, left, right) => {
  // Reverse the sub-array
  while (left < right) {
    let temp = data[left];
    data[left++] = data[right];
    data[right--] = temp;
  }
  return data;
};

const findNextPermutation = (data) => {
  if (data.length <= 1) {
    return false;
  }
  
let last = data.length - 2;

  while (last >= 0) {
    if (data[last] < data[last + 1]) {
      break;
    }
    last--;
  }

  if (last < 0) {
    return false;
  }
  let nextGreater = data.length - 1;

  for (let i = data.length - 1; i > last; i--) {
    if (data[i] > data[last]) {
      nextGreater = i;
      break;
    }
  }

  data = swap(data, nextGreater, last);

  data = reverse(data, last + 1, data.length - 1);
  return true;
};

async function handleClick() {
  // console.log("Handle Click Function");
  // const weight = document.querySelector('#distance');
  
  const output = document.getElementsByTagName("p");

  let graphs = [];
  try {
    let response = await fetch('http://localhost/final/registration/includes/calculate.php');

    if (!response.ok) {
      throw new Error('error');
    }
    let data = await response.json();
    for (let i=0;i<data.data.length;i++){
      graphs.push(JSON.parse(data.data[i].location));
      addresses[i] = data.data[i].address;
    }
    console.log({data})
    // document.write(data);
    myLatitudes = graphs;
    let d=0;
    //calculating distance in metre
    let distances = travellingSalesmanProblem(initGraph(graphs),d)
    // let path = path.join(" -> ");
    console.log(d)
    // distanceOutput.innerHTML = `distancesss is ${distances}`;

  }
   catch (error) {
    console.log(error);
  }
}
const calculateBTN = document.getElementById("calculateBTN");
calculateBTN.addEventListener('click', (e) => {
  handleClick();
 
});





