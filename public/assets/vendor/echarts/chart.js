window.onload = function () {


// First chart configuration
var chartDom1 = document.getElementById('chart1');
var myChart1 = echarts.init(chartDom1);
var option1;

const colors = ['#5470C6', '#91CC75', '#EE6666'];
option1 = {
  color: colors,
  tooltip: {
    trigger: 'axis',
    axisPointer: {
      type: 'cross'
    }
  },
  grid: {
    right: '20%'
  },
  toolbox: {
    feature: {
      dataView: { show: true, readOnly: false },
      restore: { show: true },
      saveAsImage: { show: true }
    }
  },
  legend: {
    data: ['Evaporation', 'Precipitation', 'Temperature']
  },
  xAxis: [
    {
      type: 'category',
      axisTick: {
        alignWithLabel: true
      },
      data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    }
  ],
  yAxis: [
    {
      type: 'value',
      name: 'Evaporation',
      position: 'right',
      alignTicks: true,
      axisLine: {
        show: true,
        lineStyle: {
          color: colors[0]
        }
      },
      axisLabel: {
        formatter: '{value} ml'
      }
    },
    {
      type: 'value',
      name: 'Precipitation',
      position: 'right',
      alignTicks: true,
      offset: 80,
      axisLine: {
        show: true,
        lineStyle: {
          color: colors[1]
        }
      },
      axisLabel: {
        formatter: '{value} ml'
      }
    },
    {
      type: 'value',
      name: 'Temperature',
      position: 'left',
      alignTicks: true,
      axisLine: {
        show: true,
        lineStyle: {
          color: colors[2]
        }
      },
      axisLabel: {
        formatter: '{value} °C'
      }
    }
  ],
  series: [
    {
      name: 'Evaporation',
      type: 'bar',
      data: [2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3]
    },
    {
      name: 'Precipitation',
      type: 'bar',
      yAxisIndex: 1,
      data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
    },
    {
      name: 'Temperature',
      type: 'line',
      yAxisIndex: 2,
      data: [2.0, 2.2, 3.3, 4.5, 6.3, 10.2, 20.3, 23.4, 23.0, 16.5, 12.0, 6.2]
    }
  ]
};

option1 && myChart1.setOption(option1);

// Second chart configuration
var chartDom2 = document.getElementById('chart2');
var myChart2 = echarts.init(chartDom2);
var option2;

option2 = {
  dataset: {
    source: [
      ['score', 'amount', 'product'],
      [89.3, 58212, 'Matcha Latte'],
      [57.1, 78254, 'Milk Tea'],
      [74.4, 41032, 'Cheese Cocoa'],
      [50.1, 12755, 'Cheese Brownie'],
      [89.7, 20145, 'Matcha Cocoa'],
      [68.1, 79146, 'Tea'],
      [19.6, 91852, 'Orange Juice'],
      [10.6, 101852, 'Lemon Juice'],
      [32.7, 20112, 'Walnut Brownie']
    ]
  },
  grid: { containLabel: true },
  xAxis: { name: 'amount' },
  yAxis: { type: 'category' },
  visualMap: {
    orient: 'horizontal',
    left: 'center',
    min: 10,
    max: 100,
    text: ['High Score', 'Low Score'],
    dimension: 0,
    inRange: {
      color: ['#65B581', '#FFCE34', '#FD665F']
    }
  },
  series: [
    {
      type: 'bar',
      encode: {
        x: 'amount',
        y: 'product'
      }
    }
  ]
};

option2 && myChart2.setOption(option2);
};
