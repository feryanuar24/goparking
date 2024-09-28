import { DataTypes } from "sequelize";
import sequelize from "../config/sequelize.js";

const Parking = sequelize.define(
  "Parking",
  {
    vehicleNumber: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    vehicleType: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    entryTime: {
      type: DataTypes.DATE,
      defaultValue: DataTypes.NOW,
    },
    exitTime: {
      type: DataTypes.DATE,
      allowNull: true,
    },
    parkingFee: {
      type: DataTypes.FLOAT,
      allowNull: true,
    },
  },
  {
    timestamps: true,
    indexes: [
      {
        fields: ["vehicleNumber"],
      },
    ],
  }
);

export default Parking;
