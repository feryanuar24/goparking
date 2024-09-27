import express from "express";
import sequelize from "./config/sequelize.js";
import dotenv from "dotenv";
import cors from "cors";
import parkingRoutes from "./routes/parkingRoutes.js";
import authRoutes from "./routes/authRoutes.js";
import "./models/User.js";
import "./models/Parking.js";
import associations from "./config/associations.js";

dotenv.config();

const app = express();
app.use(express.json());
app.use(cors());

app.use("/api/parking", parkingRoutes);
app.use("/api/auth", authRoutes);

associations();

const PORT = process.env.PORT || 5000;

sequelize
  .sync()
  .then(() => {
    app.listen(PORT, () => {
      console.log(`Server is running on port ${PORT}`);
    });
  })
  .catch((error) => {
    console.log("Error: ", error);
  });
