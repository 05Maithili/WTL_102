import { useState } from "react";
import axios from "axios";

function Data() {
  const [students, setStudents] = useState([]);

  const getData = async () => {
    try {
      const res = await axios.get("/studentdata.json"); // make sure file is in 'public' folder
      setStudents(res.data);
    } catch (err) {
      console.error("Error fetching data:", err);
    }
  };

  return (
    <div>
      <button onClick={getData}>Get Student Data</button>
      <h2>Student Information</h2>

      {students.length === 0 ? (
        <p>No data found!</p>
      ) : (
        students.map((stu, index) => (
          <div key={index} style={{ border: "1px solid black", padding: "10px", margin: "10px" }}>
            <p><b>Name:</b> {stu.name}</p>
            <p><b>Roll No:</b> {stu.roll_no}</p>
            <p><b>Department:</b> {stu.department}</p>
            <p><b>Marks:</b> {stu.marks}</p>
          </div>
        ))
      )}
    </div>
  );
}

function App() {
  return <Data />;
}

export default App;
