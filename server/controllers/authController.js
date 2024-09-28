import User from "../models/User.js";
import bcrypt from "bcryptjs";
import jwt from "jsonwebtoken";
import { body, validationResult } from "express-validator";

export const register = [
  body("username").notEmpty().withMessage("Username is required"),
  body("password")
    .isLength({ min: 6 })
    .withMessage("Password must be at least 6 characters long"),

  async (req, res) => {
    // Validate request body
    const errors = validationResult(req);
    if (!errors.isEmpty()) {
      return res.status(400).json({ errors: errors.array() });
    }

    try {
      // check if the username already exists
      const { username, password } = req.body;
      const existingUser = await User.findOne({
        where: {
          username: username,
        },
      });
      if (existingUser) {
        return res.status(409).json({ error: "Username already exists" });
      }

      // Hash the password and create a new user
      const hashedPassword = await bcrypt.hash(password, 10);
      const user = await User.create({ username, password: hashedPassword });

      res.status(201).json({ user });
    } catch (error) {
      res.status(500).json({ error: "Internal server error" });
    }
  },
];

export const login = [
  body("username").notEmpty().withMessage("Username is required"),
  body("password").notEmpty().withMessage("Password is required"),

  async (req, res) => {
    // Validate request body
    const errors = validationResult(req);
    if (!errors.isEmpty()) {
      return res.status(400).json({ errors: errors.array() });
    }

    try {
      // Find the user by username
      const { username, password } = req.body;
      const user = await User.findOne({ where: { username: username } });
      if (!user) {
        return res.status(404).json({ error: "User not found" });
      }

      // Check if the password is valid
      const isPasswordValid = await bcrypt.compare(password, user.password);
      if (!isPasswordValid) {
        return res.status(401).json({ error: "Invalid password" });
      }

      // Generate a JWT token
      const token = jwt.sign({ id: user.id }, process.env.JWT_SECRET, {
        expiresIn: "1h",
      });

      res
        .status(200)
        .json({ token, user: { id: user.id, username: user.username } });
    } catch (error) {
      res.status(500).json({ error: "Internal server error" });
    }
  },
];

export const verifyToken = async (req, res, next) => {
  try {
    // Check if the Authorization header is present
    const authHeader = req.headers["authorization"];
    if (!authHeader) {
      return res.status(401).json({ error: "Authorization header is missing" });
    }

    // Check if the token is present
    const token = authHeader.split(" ")[1];
    if (!token) {
      return res.status(401).json({ error: "Token is missing" });
    }

    jwt.verify(token, process.env.JWT_SECRET, (err, user) => {
      // Check if the token is valid
      if (err) {
        return res.status(403).json({ error: "Invalid token" });
      }

      req.user = user;
      next();
    });
  } catch (error) {
    res.status(500).json({ error: "Internal server error" });
  }
};
