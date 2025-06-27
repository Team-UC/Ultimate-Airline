import React from "react";
import Header from "./components/Header";
import HeaderLink from "./components/HeaderLink";
import { EmblaCarousel } from "./components/DealSlider";

const App = () => {
  return (
    <div>
      <HeaderLink />
      <Header />
      <div className="flex items-center justify-center  bg-gray-100 mx-auto">
        <EmblaCarousel />
      </div>
    </div>
  );
};

export default App;
