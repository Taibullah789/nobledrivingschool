import { Link } from 'react-router-dom'
import ab3 from '../assets/ab3.jpg'

const Blogs = () => {
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
    }
  ]

  return (
    <section id="blogs" className="py-16 sm:py-20 bg-gray-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-12 sm:mb-16">
          <h2 className="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">Blogs</h2>
          <div className="w-16 h-1 bg-green-500 mx-auto"></div>
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
          {blogPosts.map((post, index) => (
            <div key={index} className={`bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden cursor-pointer ${
              index < 2 ? 'h-32' : ''
            }`}>
              {index === 0 ? (
                <Link to="/blog-post" className="block h-full">
                  <div className={`${index < 2 ? 'p-2.5' : 'p-6'} h-full flex flex-col`}>
                    <h3 className={`font-bold text-gray-800 mb-4 line-clamp-3 hover:text-green-600 transition-colors duration-300 ${
                      index < 2 ? 'text-sm' : 'text-lg'
                    }`}>
                      {post.title}
                    </h3>
                    
                    <div className="flex flex-col space-y-2 mt-auto">
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
              ) : index === 1 ? (
                <Link to="/blog-post-2" className="block h-full">
                  <div className={`${index < 2 ? 'p-2.5' : 'p-6'} h-full flex flex-col`}>
                    <h3 className={`font-bold text-gray-800 mb-4 line-clamp-3 hover:text-green-600 transition-colors duration-300 ${
                      index < 2 ? 'text-sm' : 'text-lg'
                    }`}>
                      {post.title}
                    </h3>
                    
                    <div className="flex flex-col space-y-2 mt-auto">
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
              ) : (
                <>
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
                      <a href="#" className="text-green-600 hover:text-green-700 font-medium text-sm">
                        Read More
                      </a>
                      <div className="flex items-center text-gray-500 text-sm">
                        <span className="mr-2">🕒</span>
                        <span>{post.date}</span>
                      </div>
                    </div>
                  </div>
                </>
              )}
            </div>
          ))}
        </div>

      </div>
    </section>
  )
}

export default Blogs
