import { user } from "../models/user.model.js";
import auth from '../Auth.js';

const login = async (req, res) => {
  try {
    const { email, password } = req.body;
    const result = await user.findOne({ email });
    if (!result) {
       return res.status(400).json({ message: "invalid email or password" });
    }

    const isValidPassword = await result.comparePassword(password);
    if (!isValidPassword) {
     return res.status(400).json({ message: " password is incorrect" });
    }
    const token = await result.generatetoken();
   
    res.cookie("token", token);

    return res.status(200).json({ message: "user loged in", token});
    // const token=await user.generateToken
  } catch (err) {
    console.log(err);
    res.status(500).send({ message: "internal sever error" });
  }
};

const registerUser = async (req, res) => {
  try {
    const { name, email, password } = req.body;
    if ([email, name, password].some((field) => field?.trim() === ""))
      return res.status(400).json({ message: "fiels is empty" });

    const existingUser = await user.findOne({ email });

    if (existingUser) {
      return res.status(400).json({ message: "user already exist" });
    }

    const userCreate = await user.create({name, email, password });
    await userCreate.save();
    
    return res.status(200).json({ message: "user created successfully" });
  } catch (err) {
    console.log(err);
    res.status(500).send({ message: "internal sever error" });
  }
};
const logout = async (req, res) => {
  try {
    res.clearCookie("token");
    return res.status(200).json({ message: "user logged out" });
  } catch (err) {
    console.log(err);
    res.status(500).send({ message: "internal sever error" });
  }
};

const dashboard = async(req,res)=>{
  try{
    
    const Users = await user.find({})
    return res.status(200).json(Users)
}
catch(err){
  console.log(err)
  res.status(500).send({message:"internal sever error"})
}
};



// Edit user details
const editUser = async (req, res) => {
  try {
  // Get the user ID from the request parameters
    const { id, name, email } = req.body;

    // Check if any field is provided in the request body
    if ([name, email].every((field) => field?.trim() === "")) {
      return res.status(400).json({ message: "No fields to update" });
    }

    // Find the user by their ID
    const existingUser = await user.findById(id);
    if (!existingUser) {
      return res.status(404).json({ message: "User not found" });
    }

    // Update the user fields if provided
    if (name) existingUser.name = name;
    if (email) existingUser.email = email;
    // You may want to hash this password before saving

    // Save the updated user
    await existingUser.save();

    return res.status(200).json({ message: "User updated successfully", user: existingUser });
  } catch (err) {
    console.log(err);
    res.status(500).send({ message: "Internal server error" });
  }
};
//----------------------------delete------------------


const deleteUser = async (req, res) => {
  try {
    // The middleware will ensure that the token is valid, and user_id will be added to the request object
    const { id } = req.params;
    
    

    // Find the user by their ID in the database
    const existingUser = await user.findByIdAndDelete({_id:id});
    if (!existingUser) {
      return res.status(404).json({ message: "User not found" });
    }

    // Delete the user from the database
    await user.deleteOne({ _id: id });

    return res.status(200).json({ message: "User deleted successfully" });
  } catch (err) {
    console.log(err);
    res.status(500).send({ message: "Internal server error" });
  }
};


export { login, registerUser,logout ,dashboard,editUser,deleteUser};
  