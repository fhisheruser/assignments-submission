# Use an official base image (e.g., Node.js, Python, etc.)
FROM node:14

# Set the working directory in the container
WORKDIR /app

# Copy package.json and package-lock.json to the working directory
COPY package*.json ./

# Install application dependencies
RUN npm install

# Copy the application code to the container
COPY . .

# Expose a port (if your application listens on a specific port)
EXPOSE 3000

# Define the command to run your application
CMD ["npm", "start"]
