import "./App.css";
import {useState} from "react";
function Counter(props)
{
  const [count,setCount]=useState(props.val);
  const increment=()=>{
    setCount(count+1);
  }
  const decrement=()=>{
    setCount(count-1);
  }

  const style={
    color:count==0?"black":count<0?"red":"green"
  }
  
  return(
    
    <div className="box">
      <h1>{props.title}</h1>
      <h2>Count :<span style={style}>{count}</span> </h2>
      <button onClick={increment} className="add">Increment</button>
      <button onClick={decrement} className="del">Decrement</button>

    </div>
  );
}

function App() {
  const style={
    color:"black"
  }
  const [initial,setInitial]=useState([0,10,15,17]);
  const [res,setRes]=useState(0);
  const reset=()=>{
    setRes(prev=>prev+1);
  }
 return(
  <>
  <button style={style} onClick={reset}>Reset</button>

  {/* <Counter title="Counter-1" val={state+0}></Counter>
  <Counter title="Counter-2" val={state+10}></Counter>
  <Counter title="Counter-3" val={state+15}></Counter>
  <Counter title="Counter-4" val={state+17}></Counter> */}

  {initial.map((k,i)=>(
     <Counter key={`k${i}${res}`} title={`Counter-${i+1}`} val={k}></Counter>
  ))}
  
  </>
 );   
}

export default App
