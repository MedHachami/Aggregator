<x-layouts.client-layout title="{{$post->title}}">
<style>

    @import url('https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;1,700&family=Roboto:wght@500;700&display=swap');
    
        
        
        html {
            font-size: 15px;
        }
        
     
        
        #article_container {
            width: 80%;
            max-width: 1000px;
            height: auto;
            min-height: 608px;
            margin: 0 auto;
            margin-top: 56px;
            background-color: #000;
            box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.15);
            display: flex;
        }
        
        .article_container_img {
            flex-grow: 1;
            min-width: 50%;
            background-color: #000;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        
        .article_container_content {
            flex-grow: 1;
            padding: 55px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        h1 {
            font-size: 3rem;
            font-weight: 600;
            color: #d4dcea;
            font-family: 'Roboto', sans-serif;
            text-align: center;
        }
        
        .the{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }
        
        h4 {
            font-size: 1.125rem;
            font-weight: 600;
            font-family: 'PT Serif', serif;
            font-style: italic;
            margin: 0 16px;
        }
        
        p {
            font-family: 'PT Serif', serif;
            font-size: 1.125rem;
            color: #b1c1d4;
            text-align: center;
            line-height: 36px;
        }
        
      
        
      
        
        .divider {
            width: 60px;
            height: 4px;
            background-color: #c7cdd3;
            margin: 40px 0;
        }
        
        .line{
            width: 35px;
            height: 1px;
            background-color: #dadde1;
        }
        
        @media (max-width: 768px) {
            #article_container {
                flex-wrap: wrap;
                width: 100%;
                margin-top: 0;
            }
            .article_container_img {
                width: 100%;
                height: 608px;
            }
            .article_container_content{
                width: 100%;
            }
          }
        
          @media (min-width: 769px) and (max-width: 1024px) {
            #article_container {
                flex-wrap: wrap;
            }
            .article_container_img {
                width: 100%;
                height: 608px;
            }
            .article_container_content{
                width: 100%;
            }
          }
        
</style>
  
    <div id="article_container">
      
        <div class="article_container_content">
             <div class="the">
                 <div class="line"></div>
                 <h4>  </h4>
                 <div class="line"></div>
             </div>
             <h1>                {{$post->title}}
            </h1>
            <div class="divider"></div>
            <div class="article_container_img">
                <img src="{{$post->image}}" alt="">
            </div>
             <p>
                {{$post->description}}
             </p>
             
             
        </div>
     </div>



</x-layouts.client-layout>
