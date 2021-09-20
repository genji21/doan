import { Route } from "react-router-dom";
import FooterComponent from "../Components/Footer/FooterComponent";
import HeaderComponent from "../Components/Header/HeaderComponent";

export const MainTemplate = (props) => {
  const { Component, ...restParams } = props;

  return (
    <Route
      {...restParams}
      render={(propsRoute) => {
        return (
          <>
            <HeaderComponent />
            <Component {...propsRoute} />
            <FooterComponent />
          </>
        );
      }}
    />
  );
};
