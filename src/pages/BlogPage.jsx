import { Link } from 'react-router-dom'
import ab3 from '../assets/ab3.jpg'
import ab2 from '../assets/ab2.jpg'
import bl from '../assets/bl.jpg'

const BlogPage = () => {
  const blogPosts = [
    {
      title: "Top Questions You Must Ask A Driving School Before Enrolling",
      date: "February 11, 2023",
      hasImage: false
    },
    {
      title: "How Many PRIVATE 1 ON 1 DRIVING SESSION Should I Take To Pass Road Test?",
      date: "February 11, 2023", 
      hasImage: false
    },
    {
      title: "7 Reasons Why People Love Driving Schools",
      date: "February 11, 2023",
      hasImage: true,
      imageUrl: ab3
    },
    {
      title: "Behind The Wheel: How To Be A Better Driver",
      date: "February 11, 2023",
      hasImage: true,
      imageUrl: bl
    }
  ]

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Blog Hero Section */}
      <section className="relative h-[60vh] flex items-center justify-center">
        {/* Background Image - ab2 */}
        <div className="absolute inset-0 bg-cover bg-center bg-no-repeat" 
             style={{backgroundImage: `url(${ab2})`}}>
          <div className="absolute inset-0 bg-black bg-opacity-40"></div>
        </div>

        {/* Content - Centered "BLOGS" */}
        <div className="relative z-10 text-center">
          <h1 className="text-4xl md:text-5xl font-bold text-white">
            BLOGS
          </h1>
        </div>

        {/* SVG Shape at bottom */}
        <div className="absolute bottom-0 left-0 right-0">
          <svg 
            xmlns="http://www.w3.org/2000/svg" 
            viewBox="0 0 283.5 27.8" 
            preserveAspectRatio="none"
            className="w-full h-12 text-white transform scale-y-[-1]"
          >
            <path 
              className="fill-current" 
              d="M283.5,9.7c0,0-7.3,4.3-14,4.6c-6.8,0.3-12.6,0-20.9-1.5c-11.3-2-33.1-10.1-44.7-5.7	s-12.1,4.6-18,7.4c-6.6,3.2-20,9.6-36.6,9.3C131.6,23.5,99.5,7.2,86.3,8c-1.4,0.1-6.6,0.8-10.5,2c-3.8,1.2-9.4,3.8-17,4.7	c-3.2,0.4-8.3,1.1-14.2,0.9c-1.5-0.1-6.3-0.4-12-1.6c-5.7-1.2-11-3.1-15.8-3.7C6.5,9.2,0,10.8,0,10.8V0h283.5V9.7z M260.8,11.3	c-0.7-1-2-0.4-4.3-0.4c-2.3,0-6.1-1.2-5.8-1.1c0.3,0.1,3.1,1.5,6,1.9C259.7,12.2,261.4,12.3,260.8,11.3z M242.4,8.6	c0,0-2.4-0.2-5.6-0.9c-3.2-0.8-10.3-2.8-15.1-3.5c-8.2-1.1-15.8,0-15.1,0.1c0.8,0.1,9.6-0.6,17.6,1.1c3.3,0.7,9.3,2.2,12.4,2.7	C239.9,8.7,242.4,8.6,242.4,8.6z M185.2,8.5c1.7-0.7-13.3,4.7-18.5,6.1c-2.1,0.6-6.2,1.6-10,2c-3.9,0.4-8.9,0.4-8.8,0.5	c0,0.2,5.8,0.8,11.2,0c5.4-0.8,5.2-1.1,7.6-1.6C170.5,14.7,183.5,9.2,185.2,8.5z M199.1,6.9c0.2,0-0.8-0.4-4.8,1.1	c-4,1.5-6.7,3.5-6.9,3.7c-0.2,0.1,3.5-1.8,6.6-3C197,7.5,199,6.9,199.1,6.9z M283,6c-0.1,0.1-1.9,1.1-4.8,2.5s-6.9,2.8-6.7,2.7	c0.2,0,3.5-0.6,7.4-2.5C282.8,6.8,283.1,5.9,283,6z M31.3,11.6c0.1-0.2-1.9-0.2-4.5-1.2s-5.4-1.6-7.8-2C15,7.6,7.3,8.5,7.7,8.6	C8,8.7,15.9,8.3,20.2,9.3c2.2,0.5,2.4,0.5,5.7,1.6S31.2,11.9,31.3,11.6z M73,9.2c0.4-0.1,3.5-1.6,8.4-2.6c4.9-1.1,8.9-0.5,8.9-0.8	c0-0.3-1-0.9-6.2-0.3S72.6,9.3,73,9.2z M71.6,6.7C71.8,6.8,75,5.4,77.3,5c2.3-0.3,1.9-0.5,1.9-0.6c0-0.1-1.1-0.2-2.7,0.2	C74.8,5.1,71.4,6.6,71.6,6.7z M93.6,4.4c0.1,0.2,3.5,0.8,5.6,1.8c2.1,1,1.8,0.6,1.9,0.5c0.1-0.1-0.8-0.8-2.4-1.3	C97.1,4.8,93.5,4.2,93.6,4.4z M65.4,11.1c-0.1,0.3,0.3,0.5,1.9-0.2s2.6-1.3,2.2-1.2s-0.9,0.4-2.5,0.8C65.3,10.9,65.5,10.8,65.4,11.1	z M34.5,12.4c-0.2,0,2.1,0.8,3.3,0.9c1.2,0.1,2,0.1,2-0.2c0-0.3-0.1-0.5-1.6-0.4C36.6,12.8,34.7,12.4,34.5,12.4z M152.2,21.1	c-0.1,0.1-2.4-0.3-7.5-0.3c-5,0-13.6-2.4-17.2-3.5c-3.6-1.1,10,3.9,16.5,4.1C150.5,21.6,152.3,21,152.2,21.1z"
            />
            <path 
              className="fill-current" 
              d="M269.6,18c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C267.7,18.8,269.7,18,269.6,18z"
            />
            <path 
              className="fill-current" 
              d="M227.4,9.8c-0.2-0.1-4.5-1-9.5-1.2c-5-0.2-12.7,0.6-12.3,0.5c0.3-0.1,5.9-1.8,13.3-1.2	S227.6,9.9,227.4,9.8z"
            />
            <path 
              className="fill-current" 
              d="M204.5,13.4c-0.1-0.1,2-1,3.2-1.1c1.2-0.1,2,0,2,0.3c0,0.3-0.1,0.5-1.6,0.4	C206.4,12.9,204.6,13.5,204.5,13.4z"
            />
            <path 
              className="fill-current" 
              d="M201,10.6c0-0.1-4.4,1.2-6.3,2.2c-1.9,0.9-6.2,3.1-6.1,3.1c0.1,0.1,4.2-1.6,6.3-2.6	S201,10.7,201,10.6z"
            />
            <path 
              className="fill-current" 
              d="M154.5,26.7c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C152.6,27.5,154.6,26.8,154.5,26.7z"
            />
            <path 
              className="fill-current" 
              d="M41.9,19.3c0,0,1.2-0.3,2.9-0.1c1.7,0.2,5.8,0.9,8.2,0.7c4.2-0.4,7.4-2.7,7-2.6	c-0.4,0-4.3,2.2-8.6,1.9c-1.8-0.1-5.1-0.5-6.7-0.4S41.9,19.3,41.9,19.3z"
            />
            <path 
              className="fill-current" 
              d="M75.5,12.6c0.2,0.1,2-0.8,4.3-1.1c2.3-0.2,2.1-0.3,2.1-0.5c0-0.1-1.8-0.4-3.4,0	C76.9,11.5,75.3,12.5,75.5,12.6z"
            />
            <path 
              className="fill-current" 
              d="M15.6,13.2c0-0.1,4.3,0,6.7,0.5c2.4,0.5,5,1.9,5,2c0,0.1-2.7-0.8-5.1-1.4	C19.9,13.7,15.7,13.3,15.6,13.2z"
            />
          </svg>
        </div>
      </section>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div className="text-center mb-16">
          <h2 className="text-4xl font-bold text-gray-800 mb-4">Blogs</h2>
          <div className="w-16 h-1 bg-green-500 mx-auto"></div>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {blogPosts.map((post, index) => {
            const getBlogPostRoute = (index) => {
              switch(index) {
                case 0: return "/blog-post"
                case 1: return "/blog-post-2"
                case 2: return "/blog-post-3"
                case 3: return "/blog-post-4"
                default: return "#"
              }
            }

            return (
              <Link key={index} to={getBlogPostRoute(index)} className={`bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden cursor-pointer block ${
                index < 2 ? 'h-32' : ''
              }`}>
                {post.hasImage && (
                  <div className="h-48 overflow-hidden">
                    <img 
                      src={post.imageUrl} 
                      alt={post.title}
                      className="w-full h-full object-cover"
                    />
                  </div>
                )}
                
                <div className={`${index < 2 ? 'p-2.5' : 'p-6'}`}>
                  <h3 className={`font-bold text-gray-800 mb-4 line-clamp-3 hover:text-green-600 transition-colors duration-300 ${
                    index < 2 ? 'text-sm' : 'text-lg'
                  }`}>
                    {post.title}
                  </h3>
                  
                  <div className="flex flex-col space-y-2">
                    <span className="text-green-600 hover:text-green-700 font-medium text-sm">
                      Read More
                    </span>
                    <div className="flex items-center text-gray-500 text-sm">
                      <span className="mr-2">🕒</span>
                      <span>{post.date}</span>
                    </div>
                  </div>
                </div>
              </Link>
            )
          })}
        </div>

        <div className="text-center mt-12">
       
        </div>
      </div>
    </div>
  )
}

export default BlogPage
