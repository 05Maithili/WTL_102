const express=require("express");
const app=express();
app.use(express.json());
const stud=[
    {
        id:1,
        name:"Vaibhav",
        roll:1,
        marks:30
    },
    {
        id:2,
        name:"Ram",
        roll:2,
        marks:40
    },
    {
        id:3,
        name:"Sham",
        roll:3,
        marks:50
    },
    {
        id:4,
        name:"Suresh",
        roll:4,
        marks:70
    }
]
app.get("/",(req,res)=>{
    res.send("Welcome to express");
});

app.get("/students",(req,res)=>{
    res.send(stud);
});

app.get("/student",(req,res)=>{
    let id=req.query.id;
    let result=stud.find((obj)=>{
        return obj.id==id
    });
    if(result)
    {
        res.send(result);
    }else{
        res.send("student not found !");
    }
})

app.get("/student/marks",(req,res)=>{
    let mark=req.query.mark;
    let result=stud.filter((obj)=>{
        return obj.marks>=mark
    });
    if(result.length==0)
    {
        res.send("Student Not found");
    }
    res.send(result);
})

app.post("/student",(req,res)=>{
    const body=req.body;
    let obj={
        id:body.id,
        name:body.name,
        roll:body.roll,
        marks:body.marks
    }
   
        stud.push(obj);
        res.send("Student added successfully ");
   
   
});

app.put("/updateStudent",(req,res)=>{
    const id=req.query.id;
    const body=req.body;
    const index=stud.findIndex((o)=>{
        return o.id==id;
    });
    if(index==-1)
    {
       return res.status(404).send("Student NOT found !");
    }
    stud[index].name=body.name;
    stud[index].roll=body.roll;
    stud[index].marks=body.marks;
    res.send("data updated successfully ");
})

app.put("/updateStudent",(req,res)=>{
    const id=req.query.id;
    const body=req.body;
    const index=stud.findIndex((o)=>{
        return o.id==id;
    });
    if(index==-1)
    {
       return res.status(404).send("Student NOT found !");
    }
    stud[index].name=body.name;
    stud[index].roll=body.roll;
    stud[index].marks=body.marks;
    res.send("data updated successfully ");
})

app.delete("/deleteStudent",(req,res)=>{
    const id=req.query.id;
    
    const index=stud.findIndex((o)=>{
        return o.id==id;
    });
    if(index==-1)
    {
       return res.status(404).send("Student NOT found !");
    }
   stud.splice(index,1);
    res.send("data deleted  successfully ");
})

app.listen(3600,()=>{
    console.log("server started at 3600");
})
