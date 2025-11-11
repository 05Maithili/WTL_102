import "./App.css";
import { useState } from "react";
import axios from "axios";
import style from "./style.module.css";

function Data() {
  const [arr, setArr] = useState([]);

  const getDataa = async () => {
    try {
      const res = await axios.get("https://jsonplaceholder.typicode.com/todos");
      setArr(res.data);
    } catch (err) {
      console.error("Axios Error:", err);
    }
  };

  return (
    <div className={style.container}>
      <button onClick={getDataa}>Get Data</button>
      <h2>Received Data :</h2>

      {arr.length === 0 ? (
        <p className={style.noData}>Data Not Found!</p>
      ) : (
        <table>
          <thead>
            <tr>
              {Object.keys(arr[0]).map((key) => (
                <th key={key}>{key}</th>
              ))}
            </tr>
          </thead>
          <tbody>
            {arr.map((item) => (
              <tr key={item.id}>
                {Object.values(item).map((value, i) => (
                  <td key={i}>{String(value)}</td>
                ))}
              </tr>
            ))}
          </tbody>
        </table>
      )}
    </div>
  );
}

function App() {
  return <Data />;
}

export default App;
