1 Class Chart{
  2     private $image; // 定义图像
  3     private $title; // 定义标题
  4     private $ydata; // 定义Y轴数据
  5     private $xdata; // 定义X轴数据
  6     private $seriesName; // 定义每个系列数据的名称
  7     private $color; // 定义条形图颜色
  8     private $bgcolor; // 定义图片背景颜色
  9     private $width; // 定义图片的宽
 10     private $height; // 定义图片的长
 11     
 12     /*
 13      * 构造函数 
 14      * String title 图片标题
 15      * Array xdata 索引数组，X轴数据
 16      * Array ydata 索引数组，数字数组,Y轴数据
 17      * Array series_name 索引数组，数据系列名称
 18      */
 19     function __construct($title,$xdata,$ydata,$seriesName) {        
 20         $this->title = $title;
 21         $this->xdata = $xdata;
 22         $this->ydata = $ydata;
 23         $this->seriesName = $seriesName;
 24         $this->color = array('#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4');
 25     }
 26     
 27     /*
 28      * 公有方法，设置条形图的颜色 
 29      * Array color 颜色数组,元素取值为'#058DC7'这种形式
 30      */
 31     function setBarColor($color){
 32         $this->color = $color;
 33     }
 34 /*
 35      * 绘制折线图
 36      */
 37     public function paintLineChart() {
 38         $ydataNum = $this->arrayNum($this->ydata); // 取得数据分组的个数
 39         $max = $this->arrayMax($this->ydata); // 取得所有呈现数据的最大值
 40         $max = ($max > 100)? $max : 100;
 41         $multi = $max/100; // 如果最大数据是大于100的则进行缩小处理        
 42         $barHeightMulti = 2.2; // 条形高缩放的比例
 43         $lineWidth = 50;
 44         $chartLeft = (1+strlen($max))*12; // 设置图片左边的margin
 45         
 46         $lineY = 250; // 初始化条形图的Y的坐标
 47         // 设置图片的宽、高
 48         //$this->width = $lineWidth*count($this->xdata) + $chartLeft - $lineWidth/1.6; 
 49         
 50         $margin = 10; // 小矩形描述右边margin
 51         $recWidth = 20; // 小矩形的宽
 52         $recHeight = 15; // 小矩形的高
 53         $space = 20; // 小矩形与条形图的间距
 54         $tmpWidth = 0;
 55         // 设置图片的宽、高
 56         $lineChartWidth =  $lineWidth*count($this->xdata) + $chartLeft - $lineWidth/1.6 ;
 57         // 两个系列数据以上的加上小矩形的宽
 58         if($ydataNum > 1) {
 59             $tmpWidth = $this->arrayLengthMax($this->seriesName)*10*4/3 + $space + $recWidth + + $margin;
 60         } 
 61         $this->width = $lineChartWidth + $tmpWidth; 
 62         
 63         $this->height = 300; 
 64         $this->image = imagecreatetruecolor($this->width ,$this->height); // 准备画布
 65         $this->bgcolor = imagecolorallocate($this->image,255,255,255); // 图片的背景颜色
 66         
 67         // 设置条形图的颜色
 68         $color = array();
 69         foreach($this->color as $col) {
 70             $col = substr($col,1,strlen($col)-1);
 71             $red = hexdec(substr($col,0,2));
 72             $green = hexdec(substr($col,2,2));
 73             $blue = hexdec(substr($col,4,2));
 74             $color[] = imagecolorallocate($this->image ,$red, $green, $blue);
 75         }
 76         
 77         // 设置线段的颜色、字体的颜色、字体的路径
 78         $lineColor = imagecolorallocate($this->image ,0xcc,0xcc,0xcc);
 79         $fontColor = imagecolorallocate($this->image, 0x95,0x8f,0x8f);
 80         $fontPath = 'font/simsun.ttc';
 81         
 82         imagefill($this->image,0,0,$this->bgcolor); // 绘画背景
 83         
 84         // 绘画图的分短线与左右边线
 85         for($i = 0; $i < 6; $i++ ) {
 86             imageline($this->image,$chartLeft-10,$lineY-$barHeightMulti*$max/5/$multi*$i,$lineChartWidth,$lineY-$barHeightMulti*$max/5/$multi*$i,$lineColor);
 87             imagestring($this->image,4,5,$lineY-$barHeightMulti*$max/5/$multi*$i-8,floor($max/5*$i),$fontColor);
 88         }        
 89         imageline($this->image,$chartLeft-10,30,$chartLeft-10,$lineY,$lineColor);
 90         imageline($this->image,$lineChartWidth-1,30,$lineChartWidth-1,$lineY,$lineColor);
 91         $style = array($lineColor,$lineColor,$lineColor,$lineColor,$lineColor,$this->bgcolor,$this->bgcolor,$this->bgcolor,$this->bgcolor,$this->bgcolor);
 92         imagesetstyle($this->image,$style);
 93         
 94         // 绘制折线图的分隔线（虚线）
 95         foreach($this->xdata as $key => $val) {
 96                 $lineX = $chartLeft + 3 + $lineWidth*$key;
 97                 imageline($this->image,$lineX,30,$lineX,$lineY,IMG_COLOR_STYLED);
 98         }
 99         
100         // 绘画图的折线
101         foreach($this->ydata as $key => $val) {
102             if($ydataNum == 1) {
103                 // 一个系列数据时
104                 if($key == count($this->ydata) - 1 ) break;
105                 $lineX = $chartLeft + 3 + $lineWidth*$key;
106                 $lineY2 = $lineY-$barHeightMulti*($this->ydata[$key+1])/$multi;
107                 
108                 // 画折线
109                 if($key == count($this->ydata) - 2 ) {
110                     imagefilledellipse($this->image,$lineX+$lineWidth,$lineY2,10,10,$color[0]);
111                 }
112                 imageline($this->image,$lineX,$lineY-$barHeightMulti*$val/$multi,$lineX+$lineWidth,$lineY2,$color[0]);
113                 imagefilledellipse($this->image,$lineX,$lineY-$barHeightMulti*$val/$multi,10,10,$color[0]);
114             }elseif($ydataNum > 1) {
115                 // 多个系列的数据时
116                 foreach($val as $ckey => $cval) {
117                     
118                     if($ckey == count($val) - 1 ) break; 
119                     $lineX = $chartLeft + 3 + $lineWidth*$ckey;
120                     $lineY2 = $lineY-$barHeightMulti*($val[$ckey+1])/$multi;
121                     // 画折线
122                     if($ckey == count($val) - 2 ) {
123                         imagefilledellipse($this->image,$lineX+$lineWidth,$lineY2,10,10,$color[$key%count($this->color)]);
124                     }
125                     imageline($this->image,$lineX,$lineY-$barHeightMulti*$cval/$multi,$lineX+$lineWidth,$lineY2,$color[$key%count($this->color)]);
126                     imagefilledellipse($this->image,$lineX,$lineY-$barHeightMulti*$cval/$multi,10,10,$color[$key%count($this->color)]);
127                 }
128             }
129             
130         }
131                 
132         // 绘画条形图的x坐标的值
133         foreach($this->xdata as $key => $val) {
134             $lineX = $chartLeft + $lineWidth*$key + $lineWidth/3 - 20;
135             imagettftext($this->image,10,-65,$lineX,$lineY+15,$fontColor,$fontPath,$this->xdata[$key]);
136         }        
137         
138         // 两个系列数据以上时绘制小矩形及之后文字说明
139         if($ydataNum > 1) {
140             $x1 = $lineChartWidth + $space;
141             $y1 = 20 ;
142             foreach($this->seriesName as $key => $val) {
143                 imagefilledrectangle($this->image,$x1,$y1,$x1+$recWidth,$y1+$recHeight,$color[$key%count($this->color)]);        
144                 imagettftext($this->image,10,0,$x1+$recWidth+5,$y1+$recHeight-2,$fontColor,$fontPath,$this->seriesName[$key]);
145                 $y1 += $recHeight + 10;            
146             }
147         }
148         
149         // 绘画标题
150         $titleStart = ($this->width - 5.5*strlen($this->title))/2;
151         imagettftext($this->image,11,0,$titleStart,20,$fontColor,$fontPath,$this->title);
152         
153         // 输出图片
154         header("Content-Type:image/png");
155         imagepng ( $this->image );
156     }
157     
158     
159     /*
160      * 私有方法，当数组为二元数组时，统计数组的长度 
161      * Array arr 要做统计的数组
162      */
163     private function arrayNum($arr) {
164          $num = 0;
165          if(is_array($arr)) {
166             $num++;
167             for($i = 0; $i < count($arr); $i++){
168                 if(is_array($arr[$i])) {
169                     $num = count($arr);
170                     break;
171                 }
172             }
173          }
174          return $num;
175     }
176     
177     /*
178      * 私有方法，计算数组的深度 
179      * Array arr 数组
180      */
181     private function arrayDepth($arr) {
182          $num = 0;
183          if(is_array($arr)) {
184             $num++;
185             for($i = 0; $i < count($arr); $i++){
186                 if(is_array($arr[$i])) {
187                     $num += $this->arrayDepth($arr[$i]);
188                     break;
189                 }
190             }
191          }
192          return $num;
193     }
194     
195     /*
196      * 私有方法，找到一组中的最大值 
197      * Array arr 数字数组
198      */
199      private function arrayMax($arr) {
200         $depth = $this->arrayDepth($arr);
201         $max = 0;
202         if($depth == 1) {
203             rsort($arr);
204             $max = $arr[0];        
205         }elseif($depth > 1) {
206             foreach($arr as $val) {
207                 if(is_array($val)) {
208                     if($this->arrayMax($val) > $max) {
209                         $max = $this->arrayMax($val);
210                     }
211                 }else{                    
212                     if($val > $max){
213                         $max = $val;
214                     }
215                 }    
216             }            
217         }
218         return $max;
219     }
220     
221     /*
222      * 私有方法，求数组的平均值 
223      * Array arr 数字数组
224      */
225     function arrayAver($arr) {
226         $aver = array();
227         foreach($arr as $val) {
228             if(is_array($val)) {
229                 $aver = array_merge($aver,$val);
230             }else{
231                 $aver[] = $val;
232             }
233         }
234         return array_sum($aver)/count($aver);
235     }
236     
237     /*
238      * 私有方法，求数组中元素长度最大的值 
239      * Array arr 字符串数组,必须是汉字
240      */
241     private function arrayLengthMax($arr) {
242         $length = 0;
243         foreach($arr as $val) {
244             $length = strlen($val) > $length ? strlen($val) : $length;
245         }
246         return $length/3;
247     } 
248     
249     // 析构函数
250     function __destruct(){
251         imagedestroy($this->image);
252     }
253  }