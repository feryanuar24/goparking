import { DataTypes } from "sequelize";
import sequelize from "../config/sequelize.js";

const Parking = sequelize.define(
  "Parking",
  {
    vehicleNumber: {
      type: DataTypes.STRING,
      allowNull: false,
      validate: {
        notEmpty: true,
      },
    },
    vehicleType: {
      type: DataTypes.STRING,
      allowNull: false,
      validate: {
        notEmpty: true,
      },
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
      validate: {
        min: 0,
      },
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
