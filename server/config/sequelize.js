import { Sequelize } from "sequelize";
import dotenv from "dotenv";

dotenv.config();

const { DB_NAME, DB_USER, DB_PASS, DB_HOST } = process.env;

if (!DB_NAME || !DB_USER || !DB_PASS || !DB_HOST) {
  throw new Error("Database configuration environment variables are not set");
}

const sequelize = new Sequelize(DB_NAME, DB_USER, DB_PASS, {
  host: DB_HOST,
  dialect: "mysql",
  logging: false, // Disable logging in production
});

sequelize
  .authenticate()
  .then(() => {
    console.log("Connection has been established successfully.");
  })
  .catch((err) => {
    console.error("Unable to connect to the database:", err);
  });

export default sequelize;
