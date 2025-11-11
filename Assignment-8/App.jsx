import "./App.css";
import { useState } from "react";

function Form() {
  const [data, setData] = useState({
    fname: "",
    lname: "",
    email: "",
    mobile: ""
  });

  const [error, setError] = useState("Fill all the details");

  const handleChange = (e) => {
    setData({ ...data, [e.target.name]: e.target.value });
  };

  const reg = /^[a-z0-9._]+@[a-z]+\.[a-z]+$/;
  const regm = /^[0-9]$/;

  const handleSubmit = () => {
    if (data.fname === "") setError("First name should not be empty!");
    else if (data.lname === "") setError("Last name should not be empty!");
    else if (data.email === "") setError("Email should not be empty!");
    else if (data.mobile === "") setError("Mobile should not be empty!");
    else if (!reg.test(data.email)) setError("Email is not valid!");
    else if (data.mobile.length !== 10 || regm.test(data.mobile))
      setError("Mobile number is invalid!");
    else setError("Form submitted successfully");
  };

  return (
    <>
      <h3>Notification: {error}</h3>

      <form>
        <h1>Registration Form</h1>

        <div className="name">
          <label>
            First Name:
            <input
              type="text"
              name="fname"
              value={data.fname}
              onChange={handleChange}
            />
          </label>

          <label>
            Last Name:
            <input
              type="text"
              name="lname"
              value={data.lname}
              onChange={handleChange}
            />
          </label>
        </div>

        <div className="contact">
          <label>
            Email:
            <input
              type="text"
              name="email"
              value={data.email}
              onChange={handleChange}
            />
          </label>

          <label>
            Mobile:
            <input
              type="text"
              name="mobile"
              value={data.mobile}
              onChange={handleChange}
            />
          </label>
        </div>

        <div className="btn">
          <button type="button" onClick={handleSubmit}>
            Submit
          </button>
        </div>
      </form>
    </>
  );
}

function App() {
  return <Form />;
}

export default App;
