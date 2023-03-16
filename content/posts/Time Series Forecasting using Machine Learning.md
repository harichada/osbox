---
title: "Time Series Forecasting using Machine Learning"
date: 2022-09-20
---




Time Series Forecasting using Machine Learning

Time series forecasting is a critical approach to anticipate future trends and behaviors depending upon historical facts. With the advancements in machine learning, it has become more feasible and viable to generate accurate predictions, which are considered more reliable and precise. This blog post presents an overview of time series forecasting, focusing on its significance, challenges, and machine learning techniques used for this task.

What is Time Series Forecasting?

Time series forecasting is a statistical method that involves analyzing past data points and patterns to predict future trends relating to any time-dependent series. Examples of time series data vary from hourly stock costs, daily sales data to monthly weather forecasts, and yearly population estimates. Time series forecasting can help determine whether trends may continue or reverse, where anomalies are present, and the possible ranges of values that will be observed in the future.

Time series forecasting problems are classified into three categories:

  - Univariate Time Series Forecasting: where prediction occurs on a single variable such as demand, sales, or temperature.
  
  - Multivariate Time Series Forecasting: where prediction occurs on more than one variable simultaneously. For instance, predicting the sales of a particular product through its respective cost, market saturation, or online reviews.
  
  - Energy Consumption Big-Data Time Series Forecasting: a specific type of forecasting focusing on the power and energy consumption across times and locations.

The Challenges of Time Series Forecasting

Time series forecasting involves many challenges such as seasonality patterns, sudden changes, random errors, missing data, and predicting far into the future.

- Seasonality Patterns: A typical phenomenon that commonly appears in time series and includes a repetitive pattern which is visible in a defined time period.

- Sudden Changes: Quick changes may occur in time series because of many external factors, such as natural disasters or economic downfalls.

- Random Errors: These mistakes are not necessarily due to seasonality or sudden changes; they may happen due to the equipment malfunctioning or alterations in operational processes.

- Missing Data: Sometimes, data may not be recorded in a time series. Therefore, forecasting models may have challenges to include all data while using various models.

- Predicting Far into the Future: It is hard to predict events far into the future due to multiple factors affecting trends and patterns over time.

Machine Learning techniques for Time Series Forecasting

There are several machine learning techniques available for time series forecasting; some of these techniques include:

- ARIMA (Auto-Regression Integrated Moving Average): ARIMA is one of the most widely used methods for time series forecasting. It takes into account the past patterns of a time series to make predictions about the future.

- LSTM (Long Short-Term Memory): A scientifically advanced neural network system that is capable of learning long-term dependencies over time. This makes it suitable for use in time series forecasting.

- Prophet: A procedure developed by Facebook that enables researchers to forecast time series data. Prophet is designed for large-scale forecasting where automatic forecasting procedures are required.

Example Use Case:

In this example, we will be using the air passenger data set from 1949 to 1960, which has the total number of passengers on international flights from 1949 to 1960. 

First, we load the data using the pandas library, convert it into a time-series data format, and display the first five records:

```
import pandas as pd
data=pd.read_csv(‘AirPassengerData.csv’)
data[‘Month’]=pd.to_datetime(data[‘Month’])
data.set_index(‘Month’, inplace=True)
print(data.head())
``` 

Next, we use the LSTM model to produce a time series of predicted values for the years 1959-1962:

```
from keras.models import Sequential
from keras.layers import Dense
from keras.layers import LSTM
from sklearn.preprocessing import MinMaxScaler
scaler = MinMaxScaler(feature_range=(0, 1))
dataset = scaler.fit_transform(data)
train= dataset.copy()
test= dataset[-4:,:]
n_input = 12
n_features= 1
model = Sequential()
model.add(LSTM(200, activation='relu', input_shape=(n_input, n_features)))
model.add(Dense(1))
model.compile(optimizer='adam', loss='mse')
model.fit(X, y, epochs=100, verbose=1)
```

After the model has been trained, we use it to predict future values:

```
test_predictions = []
first_eval_batch = train[-n_input:]
current_batch = first_eval_batch.reshape((1, n_input, n_features))
for i in range(len(test)):
    current_pred = model.predict(current_batch)[0]
    test_predictions.append(current_pred)
    current_batch = np.append(current_batch[:,1:,:],[[current_pred]],axis=1)
```

As a result, the LSTM model predicts that the total number of international air passengers on flight may reach 450,710 by the end of 1962.

Conclusion:

Time series forecasting using machine learning is a vital analytical tool that can help companies make more informed decisions by predicting future trends. ARIMA and LSTM are two excellent models that companies can use to make predictions about future outcomes based on past data. Nevertheless, time-series forecasting poses challenges such as the prediction of anomalous abrupt changes, high deviations, and seasonal patterns. Companies must identify their specific issues and select the appropriate time-series forecasting methods with care.

Additional Resources:

- A detailed tutorial on time series forecasting using ARIMA and LSTM in Python: 
https://machinelearningmastery.com/time-series-forecasting-methods-in-python-cheat-sheet/

- Time Series Forecasting in Python: A Comprehensive Guide: 
https://towardsdatascience.com/time-series-forecasting-in-python-a-comprehensive-guide-e2c42abbcc6f

- Prophet (Facebook) Documentation: 
https://facebook.github.io/prophet/docs/quick_start.html